<?php

namespace Lit\Config\Form\Components;

use Ignite\Crud\Config\FormConfig;
use Ignite\Crud\CrudShow;
use Lit\Http\Controllers\Form\Components\FooterController;
use Lit\Repeatables\SocialLinkRepeatable;

class FooterConfig extends FormConfig
{
    /**
     * Controller class.
     *
     * @var string
     */
    public $controller = FooterController::class;

    /**
     * Form route prefix.
     *
     * @return string
     */
    public function routePrefix()
    {
        return 'components/footer';
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Footer',
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
        $page->card(function ($form) {
            $form->wysiwyg('info_text')
                ->title('Informationen')
                ->width(12);
            $form->block('social')
                ->title('Soziale Medien')
                ->repeatables(function ($repeatables) {
                    $repeatables->add(SocialLinkRepeatable::class);
                });
        });
    }
}
