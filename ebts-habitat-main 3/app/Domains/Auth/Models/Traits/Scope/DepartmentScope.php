<?php

namespace App\Domains\Auth\Models\Traits\Scope;

/**
 * Class DepartmentScope.
 */
trait DepartmentScope
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
