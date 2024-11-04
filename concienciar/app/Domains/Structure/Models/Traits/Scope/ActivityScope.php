<?php

namespace App\Domains\Structure\Models\Traits\Scope;


/**
 * Class ActivityScope.
 */
trait ActivityScope
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

    public function scopeForStats($query)
    {
        $query->join('categories', 'activities.category_id', '=', 'categories.id')
            ->where('categories.published', true)
            ->where('activities.published', true);

        return $query;
    }

}
