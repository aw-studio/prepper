const express = require('express');
const puppeteer = require('puppeteer');

const RENDER_CACHE = new Map();

async function ssr(url) {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    const start = Date.now();
    if (RENDER_CACHE.has(url)) {
        console.log('from cache');
        return { html: RENDER_CACHE.get(url), ttRenderMs: 0 };
    }

    try {
        // networkidle0 waits for the network to be idle (no requests for 500ms).
        // The page's JS has likely produced markup by this point, but wait longer
        // if your site lazy loads, etc.
        await page.goto(url, { waitUntil: 'networkidle0' });
        // await page.waitForSelector('#posts'); // ensure #posts exists in the DOM.
    } catch (err) {
        console.error(err);
        throw new Error('page.goto/waitForSelector timed out.');
    }

    const html = await page.content(); // serialized HTML of page DOM.
    await browser.close();

    const ttRenderMs = Date.now() - start;
    console.info(`Headless rendered page in: ${ttRenderMs}ms`);

    RENDER_CACHE.set(url, html); // cache rendered page.

    return { html, ttRenderMs };
}

const server = express();

server.post('/render', async (req, res, next) => {
    const { html, ttRenderMs } = await ssr(req.query.url);
    try {
        // // Add Server-Timing! See https://w3c.github.io/server-timing/.
        res.set(
            'Server-Timing',
            `Prerender;dur=${ttRenderMs};desc="Headless render time (ms)"`
        );
        return res.status(200).send(html); // Serve prerendered page as response.
    } catch (error) {
        next(error);
    }
});

server.listen(8080, () => console.log('Server started. Press Ctrl+C to quit'));
