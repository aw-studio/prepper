<?php

namespace Lit\Config\Pages;

use App\Http\Controllers\Pages\RootController;
use Ignite\Crud\CrudShow;
use Ignite\Crud\Fields\Block\Repeatables;
use Lit\Http\Controllers\Pages\RootController as ListackRootController;
use Lit\Repeatables\AccordionRepeatable;
use Lit\Repeatables\ImageRepeatable;
use Lit\Repeatables\SectionAsideRepeatable;
use Lit\Repeatables\SectionCardsRepeatable;
use Lit\Repeatables\TextRepeatable;
use Litstack\Pages\PagesConfig;

class RootConfig extends PagesConfig
{
    /**
     * Fjord controller class.
     *
     * @var string
     */
    public $controller = ListackRootController::class;

    /**
     * App controller class.
     *
     * @var string
     */
    public $appController = RootController::class;

    /**
     * Application route prefix.
     *
     * @param  string|null $locale
     * @return string
     */
    public function appRoutePrefix(string $locale = null)
    {
        return 'root';
    }

    /**
     * Form singular name. This name will be displayed in the navigation.
     *
     * @return array
     */
    public function names()
    {
        return [
            'singular' => 'Seite',
            'plural'   => 'Weitere Seiten',
        ];
    }

    /**
     * Setup create and edit form.
     *
     * @param  \Ignite\Crud\CrudShow $page
     * @return void
     */
    public function show(CrudShow $page)
    {
        $page->info('Hero')
            ->width(3);
        $page->card(function ($form) {
            $form->heroMacro();
        })->width(9);
        
        $page->info('Titel')
            ->width(3);
        $page->card(function ($form) {
            $form->input($this->getTitleColumnName())
                ->translatable($this->translatable())
                ->creationRules('required')
                ->rules('min:2')
                ->title('Title')
                ->width(8)
                ->hint('Seitentitel in Litstack / Aus dem Titel wird auch der Slug für die URL generiert');

            $form->modal('change_slug')
                ->title('Slug')
                ->variant('primary')
                ->preview('/<b>{'.$this->getSlugColumnName().'}</b>')
                ->name('Slug anpassen')
                ->form(function ($modal) {
                    $modal->input($this->getSlugColumnName())
                        ->width(12)
                        ->title('Slug');
                })->width(4);

            $this->prependForm($form);
        })->width(9);

        $page->info('Inhalt')
            ->width(3);
        $page->card(function ($form) {
            $form->textarea('h1')
                ->translatable($this->translatable())
                ->hint('Kurz, aber aussagekräftig (5 Wörter oder weniger), Thematik der Headline entspricht der Thematik im Content')
                ->title('H1')
                ->width(8);

            $this->makeContentBlock($form);
        })->width(9);

        $page->info('SEO')
            ->width(3);
        $page->card(function ($form) {
            $form->seo();
        })->width(9);

        $this->appendForm($page);
    }

    /**
     * Make repeatbles that should be available for pages.
     *
     * @param  Repeatables $rep
     * @return void
     */
    public function repeatables(Repeatables $repeatables)
    {
        $repeatables->add(TextRepeatable::class)->button('Text')->icon(fa('align-justify'))->variant('info');
        $repeatables->add(ImageRepeatable::class)->button('Bild')->icon(fa('image'))->variant('dark');
        $repeatables->add(SectionCardsRepeatable::class)->button('Cards')->icon(fa('th'))->variant('warning');
        $repeatables->add(SectionAsideRepeatable::class)->button('Abschnitt mit Marginalspalte')->icon(fa('columns'))->variant('warning');
        $repeatables->add(AccordionRepeatable::class)->button('Accordion')->icon(fa('chevron-down'))->variant('success');
    }
}
