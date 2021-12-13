<?php

namespace Lit\Config\Crud;

use App\Models\News;
use Ignite\Crud\Config\CrudConfig;
use Ignite\Crud\CrudIndex;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Crud\NewsController;

class NewsConfig extends CrudConfig
{
    /**
     * Model class.
     *
     * @var string
     */
    public $model = News::class;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = NewsController::class;

    /**
     * Model singular and plural name.
     *
     * @param News|null news
     * @return array
     */
    public function names(News $news = null)
    {
        return [
            'singular' => 'News',
            'plural'   => 'News',
        ];
    }

    /**
     * Get crud route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'news';
    }

    /**
     * Build index page.
     *
     * @param  \Ignite\Crud\CrudIndex $page
     * @return void
     */
    public function index(CrudIndex $page)
    {
        $page->table(function ($table) {
            $table->col('Title')->value('{title}')->sortBy('title');
        })->search('title');
    }

    /**
     * Setup show page.
     *
     * @param  \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->info('Inhalt')
            ->width(3);
        $page->card(function ($form) {
            $form->image('image')
                ->title('News Vorschaubild')
                ->expand(true)
                ->crop()
                ->maxFiles(1)
                ->width(12);
            $form->input('title')
                ->title('News Title')
                ->width(12);
            $form->textarea('excerpt')
                ->title('Kurzbeschreibung')
                ->hint('Beschreiben Sie den Newsbeitrag in wenigen Sätzen');
            $form->datetime('published_at')
                ->title('Veröffentlichungsdatum')
                ->formatted('l')
                ->width(6);
            $form->boolean('active')
                ->title('Beitrag online')
                ->hint('Aktivieren Sie diesen Switch, um den Beitrag online anzuzeigen')
                ->width(6);
        })->width(9);

        $page->info('SEO')
            ->width(3);
        $page->card(function ($form) {
            $form->seo();
        })->width(9);
    }
}
