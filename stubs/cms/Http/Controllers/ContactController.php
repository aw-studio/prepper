<?php

namespace App\Http\Controllers\Pages;

use App\Http\Resources\PageResource;
use Inertia\Inertia;
use Lit\Config\Form\Pages\ContactConfig;

class ContactController
{
    /**
     * Handle home page request.
     *
     * @return Inertia
     */
    public function __invoke()
    {
        $resource = (new PageResource(
            ContactConfig::load()->resource()->resource
        ))->toArray(request());

        return Inertia::render('Contact/Contact', [
            'form' => $resource,
        ]);
    }
}
