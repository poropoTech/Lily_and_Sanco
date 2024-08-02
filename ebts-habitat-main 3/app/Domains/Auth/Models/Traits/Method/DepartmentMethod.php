<?php

namespace App\Domains\Auth\Models\Traits\Method;

/**
 * Trait DepartmentMethod.
 */
trait DepartmentMethod
{
    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

}
