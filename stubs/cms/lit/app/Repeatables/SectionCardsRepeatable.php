<?php

namespace Lit\Repeatables;

use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;
use Ignite\Page\Table\ColumnBuilder;

class SectionCardsRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'SectionCards';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.SectionCards';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('Cards');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->block('cards')
            ->title('Cards')
            ->repeatables(function ($repeatables) {
                $repeatables->add('card', function ($form, $preview) {
                    $preview->col('{title}');
                    $form->image('image')
                        ->title('Optionales Bild')
                        ->expand(true)
                        ->crop(4 / 3)
                        ->maxFiles(1)
                        ->width(12);
                    $form->input('title')
                        ->title('Title');
                    $form->textarea('text')
                        ->title('Text');
                    $form->linkMacro();
                });
            });
    }
}
