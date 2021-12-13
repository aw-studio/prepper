<?php

namespace Lit\Macros\Form;

use Ignite\Crud\BaseForm as Form;
use Lit\Repeatables\AccordionRepeatable;
use Lit\Repeatables\ImageRepeatable;
use Lit\Repeatables\ImageTextRepeatable;
use Lit\Repeatables\InfoBoxRepeatable;
use Lit\Repeatables\SectionAsideRepeatable;
use Lit\Repeatables\SectionCardsRepeatable;
use Lit\Repeatables\TextRepeatable;

class ContentMacro
{
    public function register()
    {
        Form::macro('contentMacro', function () {
            $this->textarea('h1')
                ->hint('Kurz, aber aussagekräftig (5 Wörter oder weniger), Thematik der Headline entspricht der Thematik im Content')
                ->title('H1')
                ->width(8);

            $this->block('content')
                ->title('Content')
                ->repeatables(function ($repeatables) {
                    $repeatables->add(TextRepeatable::class)->button('Text')->icon(fa('align-justify'))->variant('light');
                    $repeatables->add(ImageRepeatable::class)->button('Bild')->icon(fa('image'))->variant('light');
                    $repeatables->add(ImageTextRepeatable::class)->button('Bild Text')->icon(fa('image'))->variant('light');
                    $repeatables->add(InfoBoxRepeatable::class)->button('Infobox')->icon(fa('info'))->variant('light');
                    $repeatables->add(AccordionRepeatable::class)->button('Accordion')->icon(fa('chevron-down'))->variant('light');
                    $repeatables->add(SectionCardsRepeatable::class)->button('Cards')->icon(fa('th'))->variant('info');
                    $repeatables->add(SectionAsideRepeatable::class)->button('Abschnitt mit Marginalspalte')->icon(fa('columns'))->variant('info');
                });
        });
    }
}
