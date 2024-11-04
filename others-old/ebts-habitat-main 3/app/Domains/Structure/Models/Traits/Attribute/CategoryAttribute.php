<?php

namespace App\Domains\Structure\Models\Traits\Attribute;

/**
 * Trait CategoryAttribute.
 */
trait CategoryAttribute
{
    public function getImageURLAttribute(): string
    {
        $url = $this->getFirstMediaUrl('image');

        return ($url == '') ? asset('img/default/category/header.jpg') : $url;
    }

    public function getIconURLAttribute(): string
    {
        $url = $this->getFirstMediaUrl('icon');

        return ($url == '') ? asset('img/default/category/icon.svg') : $url;
    }
}
