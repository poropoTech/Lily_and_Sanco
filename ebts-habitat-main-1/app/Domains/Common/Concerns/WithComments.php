<?php

namespace App\Domains\Common\Concerns;

use App\Domains\Common\Models\Comment;
use Illuminate\Database\Eloquent\Relations\morphMany;

trait WithComments
{
    /**
     * The "booting" method of the trait.
     */
    protected static function booWithComments(): void
    {
        static::deleting(function ($resource) {
            $resource->comments->each->delete();
        });
    }

    /**
     * Get all of the resource's comments.
     */
    public function comments(): morphMany
    {
        return $this->morphMany(Comment::class, 'owner');
    }

    /**
     * Get if the resource's comments are enabled.
     */
    public function commentsEnabled(): bool
    {
        return (getSysSetting('app.comments.enabled') && ($this->comments_mode_id == Comment::COMMENTS_OPEN_FREE || $this->comments_mode_id == Comment::COMMENTS_OPEN_MOD));
    }

}
