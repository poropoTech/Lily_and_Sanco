<?php

namespace App\Domains\Structure\Models\Traits\Scope;

/**
 * Class CategoryScope.
 */
trait CategoryScope
{

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyPublished($query)
    {
        return $query->wherePublished(true);
    }
}
