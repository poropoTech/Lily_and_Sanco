<?php

namespace App\Domains\Structure\Models\Traits\Relationship;

use App\Domains\Structure\Models\Activity;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CategoryRelationship.
 */
trait CategoryRelationship
{
    /**
     * @return mixed
     */
    public function activities(): hasMany
    {
        return $this->hasMany(Activity::class, 'category_id');
    }
}
