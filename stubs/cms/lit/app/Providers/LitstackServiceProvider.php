<?php

namespace Lit\Providers;

use Ignite\Crud\Fields\Route;
use Lit\Macros\Form\HeroMacro;
use Litstack\Pages\Models\Page;
use Lit\Macros\Form\ContentMacro;
use Illuminate\Support\ServiceProvider;

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

        Route::register('app', function ($collection) {
            $collection->route('Home', 'home', fn ($locale) => route('home'));
            Page::collection('root')->get()->addToRouteCollection('Seiten', $collection);
        });
    }
}
