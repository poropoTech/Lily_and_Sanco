<?php

namespace App\Domains\Responses\Models\Traits\Method;

use App\Domains\Auth\Models\User;

/**
 * Trait ResponseMethod.
 */
trait ResponseMethod
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

    public function getLastComments(User $user, $count = 10)
    {
        if ($user->isAdmin()) {
            $query = $this->comments();
        } else {
            $query = $this->comments()->onlyPublished();
        }

        return $query->with('user')
            ->latest('comments.created_at')
            ->take($count)
            ->get();
    }

    public function deleteImage(): void
    {
        $mediaItems = $this->getMedia();
        if (count($mediaItems)) {
            $mediaItems[0]->delete();
        }
    }

    public function getMediaURL(string $media)
    {
        return $this->getFirstMediaUrl($media);
    }

}
