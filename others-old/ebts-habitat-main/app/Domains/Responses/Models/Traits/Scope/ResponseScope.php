<?php

namespace App\Domains\Responses\Models\Traits\Scope;

use App\Domains\Auth\Models\User;

/**
 * Trait ResponseScope.
 */
trait ResponseScope
{
    public function scopeForCarousel($query)
    {
        if (getSysSetting('app.responses.verification-required')) {
            $query = $query->where('published', true);
        }

        return $query->orderBy('created_at', 'desc')->take(getSysSetting('app.carousel.items'));
    }

    public function scopeOnlyPublished($query)
    {
        return $query->wherePublished(true);
    }

    public function scopeChallenge($query, $challenge)
    {
        return $query->whereChallenge($challenge);
    }

    public function scopeForStats($query)
    {
        $query->join('activities', 'responses.activity_id', '=', 'activities.id')
            ->join('categories', 'activities.category_id', '=', 'categories.id')
            ->join('users', 'responses.user_id', '=', 'users.id')
            ->where('categories.published', true)
            ->where('activities.published', true)
            ->where('responses.published', true)
            ->where('users.type', User::TYPE_USER)
            ->where('users.active', true);

        return $query;
    }
}
