<?php

namespace App\Domains\Responses\Models\Traits\Attribute;

/**
 * Trait ResponseAttribute.
 */
trait ResponseAttribute
{
    public function getImageURLAttribute(): string
    {
        return $this->getFirstMediaUrl('image');
    }

    public function getImage2URLAttribute(): string
    {
        return $this->getFirstMediaUrl('image2');
    }

    public function getImage3URLAttribute(): string
    {
        return $this->getFirstMediaUrl('image3');
    }

    /**
     * @param $image
     * @return void
     */
    public function setImageAttribute($image): void
    {

    }
}
