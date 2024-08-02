<?php

namespace App\Domains\Structure\Models\Traits\Method;

use App\Domains\Auth\Models\User;
use App\Exceptions\GeneralException;

/**
 * Trait ActivityMethod.
 */
trait ActivityMethod
{
    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function isNew(?\DateTime $dateTime): bool
    {
        if (is_null($dateTime)) {
            return true;
        }

        return ($this->created_at > $dateTime) ? true : false;
    }

    public function isDone(User $user): bool
    {
        return ($this->isCollectiveChallengeDone($user) && $this->isIndividualChallengeDone($user));
    }

    public function isViewed(User $user): bool
    {
        return (bool)($this->views()->where('user_id', $user->id)->count());
    }

    public function isCollectiveChallengeDone(User $user): bool
    {
        $userPublishedResponses = $this->responses()
            ->onlyPublished()
            ->challenge('collective')
            ->where('user_id', $user->id)->count();

        if ($userPublishedResponses) {
            return true;
        }

        return false;
    }

    public function isIndividualChallengeDone(User $user): bool
    {
        $userPublishedResponses = $this->responses()
            ->onlyPublished()
            ->challenge('individual')
            ->where('user_id', $user->id)->count();

        if ($userPublishedResponses) {
            return true;
        }

        return false;
    }

    public function isChallengeDone(User $user, string $challenge): bool
    {
        switch ($challenge) {
            case 'individual':
                return $this->isIndividualChallengeDone($user);
            case 'collective':
                return $this->isCollectiveChallengeDone($user);
        }

        return false;
    }

    public function getResponsesByUser(User $user)
    {
        return $this->responses()->where('user_id', $user->id)->count();
    }


    public function getPublishedResponses()
    {
        return $this->responses()->onlyPublished()->orderBy('created_at', 'desc')->get();
    }

    public function getPublishedResponsesCount()
    {
        return $this->responses()->onlyPublished()->count();
    }

    public function canUserCreateResponse(User $user, string $challenge)
    {
        if (! $this->isActive() || ! $this->isPublished()) {
            return false;
        }

        return ! $this->isChallengeDone($user, $challenge);
    }

    public function getResponseTypeByChallenge(string $challenge)
    {
        switch ($challenge) {
            case 'individual':
                return $this->individual_type_id;
            case 'collective':
                return $this->collective_type_id;
        }

        throw new GeneralException("Not Challenge");
    }


    public function deleteImages(): void
    {
        $this->clearMediaCollection('image_header');
        $this->clearMediaCollection('image_card');
    }
}
