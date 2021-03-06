<?php

namespace Lit\Config;

use Ignite\Application\Navigation\Config;
use Ignite\Application\Navigation\Navigation;
use Lit\Config\Form\Components\FooterConfig;
use Lit\Config\Crud\RedirectConfig;
use Lit\Config\Form\Navigations\NavigationsConfig;
use Lit\Config\Form\Pages\ContactConfig;
use Lit\Config\Form\Pages\HomeConfig;
use Lit\Config\Pages\RootConfig;

class NavigationConfig extends Config
{
    /**
     * Topbar navigation entries.
     *
     * @param  \Ignite\Application\Navigation\Navigation $nav
     * @return void
     */
    public function topbar(Navigation $nav)
    {
        $nav->section([
            $nav->preset('profile'),
        ]);

        $nav->section([
            $nav->title(__lit('navigation.user_administration')),

            $nav->preset('user.user', ['icon' => fa('users')]),
            $nav->preset('permissions'),
        ]);
    }

    /**
     * Main navigation entries.
     *
     * @param  \Ignite\Application\Navigation\Navigation $nav
     * @return void
     */
    public function main(Navigation $nav)
    {
        $nav->section([
            $nav->title('Seiten'),

            $nav->preset(HomeConfig::class)->icon(fa('home')),
            $nav->preset(ContactConfig::class)->icon(fa('id-card')),
            $nav->preset(RootConfig::class, ['icon' => fa('newspaper')]),
        ]);
        $nav->section([
            $nav->title('Daten Objekte'),

            // Crud
        ]);
        $nav->section([
            $nav->title('URL'),
            $nav->preset(RedirectConfig::class)->icon(fa('directions')),
        ]);
        $nav->section([
            $nav->title('Komponenten'),

            $nav->preset(NavigationsConfig::class, ['icon' => fa('list')]),
            $nav->preset(FooterConfig::class, ['icon' => fa('address-card')]),
            // Footer
        ]);
    }
}
