<?php

namespace App\Domains\Notifications\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait UserNotificationRelationship.
 */
trait UserNotificationRelationship
{

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
