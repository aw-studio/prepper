<?php

namespace App\Http\Resources\Concerns;

trait ResourceHasMeta
{
    /**
     * Gets the meta attributes.
     *
     * @return array
     */
    public function meta()
    {
        return [
            'title'       => $this->metaTitle(),
            'description' => $this->metaDescription(),
            'author'      => $this->metaAuthor(),
        ];
    }
}
