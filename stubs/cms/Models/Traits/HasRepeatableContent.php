<?php

namespace App\Models\Traits;

use Ignite\Crud\Models\LitFormModel;
use Illuminate\Http\Resources\Json\JsonResource;

trait HasRepeatableContent
{
    public function getRepeatableResource($repeatable)
    {
        if ($this instanceof JsonResource) {
            $class = $this->resource;
        }

        if (! method_exists($class, $repeatable)) {
            return;
        }

        return $class->{$repeatable}->map(function ($item) {
            if ($item instanceof LitFormModel) {
                return $item->resource()->toArray(request());
            }
        })->toArray();
    }
}
