<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Domains\Auth\Models\PasswordHistory;
use App\Domains\Common\Models\Comment;
use App\Domains\Responses\Models\Response;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->morphMany(PasswordHistory::class, 'model');
    }

    public function responses(): hasMany
    {
        return $this->hasMany(Response::class, 'user_id');
    }

    public function comments(): hasMany
    {
        return $this->hasMany(Comment::class, 'usser_id');
    }
}
