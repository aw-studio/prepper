<?php

namespace Lit\Config\Form\Pages;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Pages\HomeController;
use Litstack\Meta\Traits\FormHasMeta;

class HomeConfig extends FormConfig
{
    use FormHasMeta;

    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = HomeController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'pages/home';
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Home',
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
        $page->info('Hero')
            ->width(3);
        $page->card(function ($form) {
            $form->heroMacro();
        })->width(9);
        
        $page->info('Inhalt')
            ->width(3);
        $page->card(function ($form) {
            $form->contentMacro();
        })->width(9);

        $page->info('SEO')
            ->width(3);
        $page->card(function ($form) {
            $form->seo();
        })->width(9);
    }
}
