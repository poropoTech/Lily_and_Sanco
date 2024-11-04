<?php

namespace App\Domains\Common\Models\Traits\Scope;

/**
 * Trait CommentScope.
 */
trait CommentScope
{

    public function scopeOnlyPublished($query)
    {
        return $query->wherePublished(true);
    }
}
