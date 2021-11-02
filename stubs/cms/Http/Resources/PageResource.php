<?php

namespace App\Http\Resources;

use Ignite\Crud\FormResource;

class PageResource extends FormResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'meta' => $this->meta(),
        ]);
    }

    /**
     * Gets the meta attributes.
     *
     * @return array
     */
    protected function meta()
    {
        return [
            'title'       => $this->config()->metaTitle($this->resource),
            'description' => $this->config()->metaDescription($this->resource),
            'author'      => $this->config()->metaAuthor($this->resource),
        ];
    }

    /**
     * Gets the config instance.
     *
     * @return mixed
     */
    protected function config()
    {
        return $this->resource->config;
    }
}
