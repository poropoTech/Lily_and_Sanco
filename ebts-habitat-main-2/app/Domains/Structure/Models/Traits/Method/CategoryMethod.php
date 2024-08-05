<?php

namespace App\Domains\Structure\Models\Traits\Method;

/**
 * Trait CategoryMethod.
 */
trait CategoryMethod
{
    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    public function deleteImage(): void
    {
        $mediaItems = $this->getMedia('image');
        if (count($mediaItems)) {
            $mediaItems[0]->delete();
        }
    }
    public function deleteIcon(): void
    {
        $mediaItems = $this->getMedia('icon');
        if (count($mediaItems)) {
            $mediaItems[0]->delete();
        }
    }

}
