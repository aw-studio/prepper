<?php

namespace AwStudio\Prepper\Commands;

use Ignite\Crud\Models\Form;
use Ignite\Crud\Models\ListItem;
use Ignite\Crud\Models\Repeatable;
use Illuminate\Console\Command;
use Litstack\Pages\Models\Page;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prepper:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $isMultilang;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->isMultilang = count(config('translatable.locales') ?: []) > 1;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->makeImprintPage();
        $this->makePrivacyPolicyPage();


        $this->makeMainNavigationForm();
        $this->makeHomePageForm();

        $this->makeListItems();
        $this->makeRepeatables();
    }

    public function makeImprintPage()
    {
        $impressum = [
            'collection'  => 'root',
            'config_type' => 'Lit\\Config\\Pages\\RootConfig',
            'title'       => 'Impressum',
            'slug'        => 'impressum',
        ];

        if (! $this->isMultilang) {
            $impressum['value'] = [
                'h1' => 'Impressum',
            ];
        } else {
            $impressum['de'] = [
                't_title' => 'Impressum',
                't_slug'  => 'impressum',
                'value'   => [
                    'h1' => 'Impressum',
                ],
            ];
            $impressum['en'] = [
                't_title' => 'Imprint',
                't_slug'  => 'imprint',
                'value'   => [
                    'h1' => 'Imprint',
                ],
            ];
        }

        Page::create($impressum);
    }

    public function makePrivacyPolicyPage()
    {
        $datenschutz = [
            'collection'  => 'root',
            'config_type' => 'Lit\\Config\\Pages\\RootConfig',
            'title'       => 'Datenschutz',
            'slug'        => 'datenschutz',
        ];

        if (! $this->isMultilang) {
            $datenschutz['value'] = [
                'h1' => 'Datenschutz',
            ];
        } else {
            $datenschutz['de'] = [
                't_title' => 'Datenschutz',
                't_slug'  => 'Datenschutz',
                'value'   => [
                    'h1' => 'Datenschutz',
                ],
            ];
            $datenschutz['en'] = [
                't_title' => 'Privacy policy',
                't_slug'  => 'privacy-policy',
                'value'   => [
                    'h1' => 'Privacy policy',
                ],
            ];
        }

        Page::create($datenschutz);
    }

    public function makeMainNavigationForm()
    {
        Form::create([
            'config_type' => 'Lit\\Config\\Form\\Navigations\\NavigationsConfig',
            'form_type'   => 'show',
            'collection'  => 'navigations',
            'form_name'   => 'navigations',
            'value'       => null,
        ]);
    }
    public function makeHomePageForm()
    {
        Form::create([
            'config_type' => 'Lit\\Config\\Form\\Pages\\HomeConfig',
            'form_type'   => 'show',
            'collection'  => 'pages',
            'form_name'   => 'navigations',
            'value'       => null,
        ]);
    }

    public function makeListItems()
    {
        $linkHome = [
            'model_type'   => 'Ignite\\Crud\\Models\\Form',
            'model_id'     => '1',
            'parent_id'    => '0',
            'config_type'  => 'Lit\\Config\\Form\\Navigations\\NavigationsConfig',
            'form_type'    => 'show',
            'field_id'     => 'main',
            'order_column' => '0',
            'active'       => true,
        ];

        if (! $this->isMultilang) {
            $linkHome['value'] = [
                'title' => 'Start',
                'route' => 'app.home',
            ];
        } else {
            $linkHome['value'] = [
                'route' => 'app.home',
            ];
            $linkHome['de'] = [
                'value' => [
                    'title' => 'Startseite',
                ],
            ];
            $linkHome['en'] = [
                'value' => [
                    'title' => 'Home',
                ],
            ];
        }

        ListItem::create($linkHome);

        $linkImprint = [
            'model_type'   => 'Ignite\\Crud\\Models\\Form',
            'model_id'     => '1',
            'parent_id'    => '0',
            'config_type'  => 'Lit\\Config\\Form\\Navigations\\NavigationsConfig',
            'form_type'    => 'show',
            'field_id'     => 'meta',
            'order_column' => '0',
            'active'       => true,
        ];

        if (! $this->isMultilang) {
            $linkImprint['value'] = [
                'title' => 'Impressum',
                'route' => 'app.root.1',
            ];
        } else {
            $linkImprint['value'] = [
                'route' => 'app.root.1',
            ];
            $linkImprint['de'] = [
                'value' => [
                    'title' => 'Impressum',
                ],
            ];
            $linkImprint['en'] = [
                'value' => [
                    'title' => 'Imprint',
                ],
            ];
        }

        ListItem::create($linkImprint);

        $dataPolicy = [
            'model_type'   => 'Ignite\\Crud\\Models\\Form',
            'model_id'     => '1',
            'parent_id'    => '0',
            'config_type'  => 'Lit\\Config\\Form\\Navigations\\NavigationsConfig',
            'form_type'    => 'show',
            'field_id'     => 'meta',
            'order_column' => '0',
            'active'       => true,
        ];

        if (! $this->isMultilang) {
            $dataPolicy['value'] = [
                'title' => 'Datenschutz',
                'route' => 'app.root.2',
            ];
        } else {
            $dataPolicy['value'] = [
                'route' => 'app.root.2',
            ];
            $dataPolicy['de'] = [
                'value' => [
                    'title' => 'Datenschutz',
                ],
            ];
            $dataPolicy['en'] = [
                'value' => [
                    'title' => 'Privacy Policy',
                ],
            ];
        }

        ListItem::create($dataPolicy);
    }

    public function makeRepeatables()
    {
        $homeText = [
            'model_type'   => 'Ignite\\Crud\\Models\\Form',
            'model_id'     => 2,
            'config_type'  => 'Lit\\Config\\Form\\Pages\\HomeConfig',
            'form_type'    => 'show',
            'field_id'     => 'content',
            'type'         => 'Text',
            'order_column' => 0,
        ];

        if (! $this->isMultilang) {
            $homeText['value'] = [
                'text' => '<h2><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h2><h3><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h3><h4><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><ul><li><p>Mehl</p></li><li><p>Milch</p></li><li><p>Eier</p></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><ol><li><p>Dorsch</p></li><li><p>Zander</p></li><li><p>Zackenbarsch</p></li></ol>',
            ];
        } else {
            $homeText['de'] = [
                'value' => [
                    'text' => '<h2><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h2><h3><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h3><h4><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><ul><li><p>Mehl</p></li><li><p>Milch</p></li><li><p>Eier</p></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><ol><li><p>Dorsch</p></li><li><p>Zander</p></li><li><p>Zackenbarsch</p></li></ol>',
                ],
            ];
            $homeText['en'] = [
                'value' => [
                    'text' => '<h2><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h2><h3><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h3><h4><strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia.</strong></h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><ul><li><p>Mehl</p></li><li><p>Milch</p></li><li><p>Eier</p></li></ul><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere, nihil? Odit cumque consequuntur expedita quia. Vel error quia magnam! Cupiditate magnam sapiente distinctio labore possimus esse tempore, debitis hic nostrum.</p><ol><li><p>Dorsch</p></li><li><p>Zander</p></li><li><p>Zackenbarsch</p></li></ol>',
                ],
            ];
        }

        Repeatable::create($homeText);

        $cardSection = Repeatable::create([
            'model_type'   => 'Ignite\\Crud\\Models\\Form',
            'model_id'     => 2,
            'config_type'  => 'Lit\\Config\\Form\\Pages\\HomeConfig',
            'form_type'    => 'show',
            'field_id'     => 'content',
            'type'         => 'SectionCards',
            'value'        => null,
            'order_column' => 2,
        ]);

        $cards = [
            'model_type'   => 'Ignite\\Crud\\Models\\Repeatable',
            'model_id'     => $cardSection->id,
            'config_type'  => 'Lit\\Config\\Form\\Pages\\HomeConfig',
            'form_type'    => 'show',
            'field_id'     => 'cards',
            'type'         => 'card',
            'order_column' => 1,
        ];

        if (! $this->isMultilang) {
            $cards['value'] = [
                'title' => 'fgdgdhfgdfh',
                'text'  => 'dfghgfhhghghdgf',
            ];
        } else {
            $cards['de'] = [
                'value' => [
                    'title' => 'fgdgdhfgdfh',
                    'text'  => 'dfghgfhhghghdgf',
                ],
            ];
            $cards['en'] = [
                'value' => [
                    'title' => 'fgdgdhfgdfh',
                    'text'  => 'dfghgfhhghghdgf',
                ],
            ];
        }

        Repeatable::create($cards);
    }
}
