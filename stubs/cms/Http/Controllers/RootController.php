<?php

namespace App\Http\Controllers\Pages;

use App\Http\Resources\RootPageResource;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Litstack\Pages\ManagesPages;

class RootController
{
    use ManagesPages;

    /**
     * Handle page request.
     *
     * @param  Request $request
     * @param  string  $slug
     * @return Inertia
     */
    public function __invoke(Request $request, $slug)
    {
        $resource = (new RootPageResource(
            $this->getLitstackPage($slug)->resource()->resource
        ))->toArray($request);

        return Inertia::render('Root/Root', [
            'form' => $resource,
        ]);
    }
}
