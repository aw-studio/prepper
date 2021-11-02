<?php

namespace Lit\Config\Form\Navigations;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Navigations\NavigationsController;

class NavigationsConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = NavigationsController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'navigations';
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Navigationen',
        ];
    }

    /**
     * Setup form page.
     *
     * @param  \Lit\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->info('Hauptnavigation')
            ->width(3);
        $page->card(function ($form) {
            $form->nav('main')->maxDepth(1);
        })->width(9);

        $page->info('Metanavigation')
            ->width(3);
        $page->card(function ($form) {
            $form->nav('meta')->maxDepth(1);
        })->width(9);
    }
}
