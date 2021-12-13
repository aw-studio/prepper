<?php

namespace Lit\Providers;

use Ignite\Crud\Fields\Route;
use Illuminate\Support\ServiceProvider;
use Lit\Macros\Form\ContentMacro;
use Lit\Macros\Form\HeroMacro;
use Lit\Macros\Form\LinkMacro;
use Litstack\Pages\Models\Page;

class LitstackServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(lit_resource_path('views'), 'lit');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        (new ContentMacro)->register();
        (new HeroMacro)->register();
        (new LinkMacro)->register();

        Route::register('app', function ($collection) {
            $collection->route('Home', 'home', fn ($locale) => route('home'));
            $collection->route('Contact', 'contact', fn ($locale) => route('contact'));
            Page::collection('root')->get()->addToRouteCollection('Seiten', $collection);
        });
    }
}
