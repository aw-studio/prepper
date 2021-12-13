<?php

namespace Lit\Repeatables;

use Ignite\Crud\Fields\Block\Repeatable;
use Ignite\Crud\Fields\Block\RepeatableForm;
use Ignite\Page\Table\ColumnBuilder;

class ImageTextRepeatable extends Repeatable
{
    /**
     * Repeatable type.
     *
     * @var string
     */
    protected $type = 'ImageText';

    /**
     * The represantive view of the repeatable.
     *
     * @var string
     */
    protected $view = 'rep.ImageText';

    /**
     * Build the repeatable preview.
     *
     * @param  ColumnBuilder $preview
     * @return void
     */
    public function preview(ColumnBuilder $preview): void
    {
        $preview->col('Text')->value('Bild Text');
    }

    /**
     * Build the repeatable form.
     *
     * @param  RepeatableForm $form
     * @return void
     */
    public function form(RepeatableForm $form): void
    {
        $form->image('image')
            ->title('Bild')
            ->expand(true)
            ->crop(4 / 3)
            ->maxFiles(1)
            ->width(6);
        $form->textarea('text')
            ->title('Text')
            ->width(6);
        $form->boolean('text_first')
            ->title('Text links')
            ->hint('Wenn aktiv wird links der text und rechts das Bild angezeigt, sonst umgekehrt')
            ->width(12);
    }
}
