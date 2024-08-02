<?php

namespace App\Domains\Responses\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use App\Domains\Structure\Models\Activity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait ResponseRelationship.
 */
trait ResponseRelationship
{

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verifier_id');
    }
}
