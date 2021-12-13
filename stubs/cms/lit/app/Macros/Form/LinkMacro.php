<?php

namespace Lit\Macros\Form;

use Ignite\Crud\BaseForm as Form;

class LinkMacro
{
    public function register()
    {
        Form::macro('linkMacro', function ($prefix = null) {
            if ($prefix) {
                $prefix = $prefix.'_';
            }
            $this->radio($prefix.'link_type')
                ->title('Art der Verlinkung')
                ->options([
                    'internal' => 'intern',
                    'external' => 'extern',
                    'none'     => 'keine',
                ]);

            $this->route($prefix.'route')
                ->collection('app')
                ->when($prefix.'link_type', 'internal')
                ->title('Seite auswählen');

            $this->input($prefix.'external_link')
                ->when($prefix.'link_type', 'external')
                ->type('url')
                ->title('URL eingeben');
        });
    }
}
