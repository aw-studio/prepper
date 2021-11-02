<?php

namespace App\Http\Controllers\Pages;

use App\Http\Resources\PageResource;
use Inertia\Inertia;
use Lit\Config\Form\Pages\HomeConfig;

class HomeController
{
    /**
     * Handle home page request.
     *
     * @return Inertia
     */
    public function __invoke()
    {
        $resource = (new PageResource(
            HomeConfig::load()->resource()->resource
        ))->toArray(request());

        return Inertia::render('Home/Home', [
            'form' => $resource,
        ]);
    }
}
