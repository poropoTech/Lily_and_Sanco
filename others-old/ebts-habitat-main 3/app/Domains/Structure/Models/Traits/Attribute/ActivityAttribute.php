<?php

namespace App\Domains\Structure\Models\Traits\Attribute;

/**
 * Trait ActivityAttribute.
 */
trait ActivityAttribute
{
    public function getImageHeaderURLAttribute(): string
    {
        $url = $this->getFirstMediaUrl('image_header');
        return ($url == '') ? asset('img/default/activity/header.jpg') : $url;
    }

    public function getImageCardURLAttribute(): string
    {
        $url = $this->getFirstMediaUrl('image_card');
        return ($url == '') ? asset('img/default/activity/card.jpg') : $url;
    }

    public function getCategoryNameAttribute(): string
    {
        return $this->category->name;
    }
}
