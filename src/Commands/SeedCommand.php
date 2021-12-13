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
        $this->makeContactPageForm();
        $this->makeFooterForm();

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
        $home = [
            'config_type' => 'Lit\\Config\\Form\\Pages\\HomeConfig',
            'form_type'   => 'show',
            'collection'  => 'pages',
            'form_name'   => 'home',
        ];

        if (! $this->isMultilang) {
            $home['value'] = [
                'h1'            => 'Startseite',
                'has_hero'      => true,
                'hero_headline' => 'Startseite',
                'hero_text'     => 'Über die Startseite',
            ];
        } else {
            $home['value'] = [
                'h1'            => 'Startseite',
                'has_hero'      => true,
                'hero_headline' => 'Startseite',
                'hero_text'     => 'Über die Startseite',
            ];
            $home['de'] = [
                'value' => [
                    'h1'            => 'Startseite',
                    'has_hero'      => true,
                    'hero_headline' => 'Startseite',
                    'hero_text'     => 'Über die Startseite',
                ],
            ];
            $home['en'] = [
                'value' => [
                    'h1'            => 'Home',
                    'has_hero'      => true,
                    'hero_headline' => 'Startseite',
                    'hero_text'     => 'Über die Startseite',
                ],
            ];
        }

        $form = Form::create($home);

        $form->addMediaFromUrl('https://source.unsplash.com/random/1280x500')->toMediaCollection('hero_image');
    }
    public function makeContactPageForm()
    {
        $contact = [
            'config_type' => 'Lit\\Config\\Form\\Pages\\ContactConfig',
            'form_type'   => 'show',
            'collection'  => 'pages',
            'form_name'   => 'contact',
        ];

        if (! $this->isMultilang) {
            $contact['value'] = [
                'h1' => 'Kontakt',
            ];
        } else {
            $contact['value'] = [
                'h1' => 'Kontakt',
            ];
            $contact['de'] = [
                'value' => [
                    'h1' => 'Kontakt',
                ],
            ];
            $contact['en'] = [
                'value' => [
                    'h1' => 'Contact',
                ],
            ];
        }

        Form::create($contact);
    }
    public function makeFooterForm()
    {
        $footer = [
            'config_type' => 'Lit\\Config\\Form\\Components\\FooterConfig',
            'form_type'   => 'show',
            'collection'  => 'components',
            'form_name'   => 'footer',
        ];

        if (! $this->isMultilang) {
            $footer['value'] = [
                'info_text' => '<h3>email@domain.com</h3><h3>+49 123 34567890</h3><p>Musterfirma GmbH<br>Platzhalterstraßfe 123a<br>12345 Musterstadt</p>',
            ];
        } else {
            $footer['value'] = [
                'info_text' => '<h3>email@domain.com</h3><h3>+49 123 34567890</h3><p>Musterfirma GmbH<br>Platzhalterstraßfe 123a<br>12345 Musterstadt</p>',
            ];
            $footer['de'] = [
                'value' => [
                    'info_text' => '<h3>email@domain.com</h3><h3>+49 123 34567890</h3><p>Musterfirma GmbH<br>Platzhalterstraßfe 123a<br>12345 Musterstadt</p>',
                ],
            ];
            $footer['en'] = [
                'value' => [
                    'info_text' => '<h3>email@domain.com</h3><h3>+49 123 34567890</h3><p>Musterfirma GmbH<br>Platzhalterstraßfe 123a<br>12345 Musterstadt</p>',
                ],
            ];
        }

        Form::create($footer);
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

        $linkContact = [
            'model_type'   => 'Ignite\\Crud\\Models\\Form',
            'model_id'     => '1',
            'parent_id'    => '0',
            'config_type'  => 'Lit\\Config\\Form\\Navigations\\NavigationsConfig',
            'form_type'    => 'show',
            'field_id'     => 'main',
            'order_column' => '1',
            'active'       => true,
        ];

        if (! $this->isMultilang) {
            $linkContact['value'] = [
                'title' => 'Kontakt',
                'route' => 'app.contact',
            ];
        } else {
            $linkContact['value'] = [
                'route' => 'app.contact',
            ];
            $linkContact['de'] = [
                'value' => [
                    'title' => 'Kontakt',
                ],
            ];
            $linkContact['en'] = [
                'value' => [
                    'title' => 'Contact',
                ],
            ];
        }

        ListItem::create($linkContact);

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

        $contactText = [
            'model_type'   => 'Ignite\\Crud\\Models\\Form',
            'model_id'     => 2,
            'config_type'  => 'Lit\\Config\\Form\\Pages\\ContactConfig',
            'form_type'    => 'show',
            'field_id'     => 'content',
            'type'         => 'Text',
            'order_column' => 0,
        ];

        if (! $this->isMultilang) {
            $contactText['value'] = [
                'text' => '<h3>email@domain.com</h3><h3>+49 123 34567890</h3><p>Musterfirma GmbH<br>Platzhalterstraßfe 123a<br>12345 Musterstadt</p>',
            ];
        } else {
            $contactText['de'] = [
                'value' => [
                    'text' => '<h3>email@domain.com</h3><h3>+49 123 34567890</h3><p>Musterfirma GmbH<br>Platzhalterstraßfe 123a<br>12345 Musterstadt</p>',
                ],
            ];
            $contactText['en'] = [
                'value' => [
                    'text' => '<h3>email@domain.com</h3><h3>+49 123 34567890</h3><p>Musterfirma GmbH<br>Platzhalterstraßfe 123a<br>12345 Musterstadt</p>',
                ],
            ];
        }

        Repeatable::create($contactText);

        $footerSocial = [
            'model_type'   => 'Ignite\\Crud\\Models\\Form',
            'model_id'     => 4,
            'config_type'  => 'Lit\\Config\\Form\\Components\\FooterConfig',
            'form_type'    => 'show',
            'field_id'     => 'social',
            'type'         => 'SocialLink',
            'order_column' => 0,
        ];

        if (! $this->isMultilang) {
            $footerSocial['value'] = [
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="32" height="32" preserveAspectRatio="xMinYMin" class="fill-current icon__icon"><path d="M8.695 6.937v1.377H7.687v1.683h1.008V15h2.072V9.997h1.39s.131-.807.194-1.69h-1.576v-1.15c0-.173.226-.404.45-.404h1.128V5h-1.535C8.644 5 8.695 6.685 8.695 6.937z"></path><path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0 2C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10z"></path></svg>',
                'link' => 'https://facebook.com',
            ];
        } else {
            $footerSocial['de'] = [
                'value' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="32" height="32" preserveAspectRatio="xMinYMin" class="fill-current icon__icon"><path d="M8.695 6.937v1.377H7.687v1.683h1.008V15h2.072V9.997h1.39s.131-.807.194-1.69h-1.576v-1.15c0-.173.226-.404.45-.404h1.128V5h-1.535C8.644 5 8.695 6.685 8.695 6.937z"></path><path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0 2C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10z"></path></svg>',
                    'link' => 'https://facebook.com',
                ],
            ];
            $footerSocial['en'] = [
                'value' => [
                    'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="32" height="32" preserveAspectRatio="xMinYMin" class="fill-current icon__icon"><path d="M8.695 6.937v1.377H7.687v1.683h1.008V15h2.072V9.997h1.39s.131-.807.194-1.69h-1.576v-1.15c0-.173.226-.404.45-.404h1.128V5h-1.535C8.644 5 8.695 6.685 8.695 6.937z"></path><path d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0 2C4.477 20 0 15.523 0 10S4.477 0 10 0s10 4.477 10 10-4.477 10-10 10z"></path></svg>',
                    'link' => 'https://facebook.com',
                ],
            ];
        }

        Repeatable::create($footerSocial);

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
                'title' => 'Lorem Ipsum',
                'text'  => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.',
            ];
        } else {
            $cards['de'] = [
                'value' => [
                    'title' => 'Lorem Ipsum',
                    'text'  => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.',
                ],
            ];
            $cards['en'] = [
                'value' => [
                    'title' => 'Lorem Ipsum',
                    'text'  => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.',
                ],
            ];
        }

        $repeatable = Repeatable::create($cards);

        $repeatable->addMediaFromUrl('https://source.unsplash.com/random/800x600')->toMediaCollection('image');
    }
}
