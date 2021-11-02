<?php

namespace Lit\Macros\Form;

use Ignite\Crud\BaseForm as Form;

class HeroMacro
{
    public function register()
    {
        Form::macro('heroMacro', function () {
            $this->boolean('has_hero')->title('Hero anzeigen');
            $this->image('hero_image')
                ->title('Header-Bild')
                ->maxFiles(1)
                ->expand()
                ->when('has_hero', true);
            $this->input('hero_headline')
                ->title('Überschrift')
                ->when('has_hero', true);
            $this->textarea('hero_text')
                ->title('Text')
                ->when('has_hero', true);
        });
    }
}
