<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class DepartmentRelationship.
 */
trait DepartmentRelationship
{
    /**
     * @return mixed
     */
    public function users(): hasMany
    {
        return $this->hasMany(User::class, 'department_id');
    }
}
