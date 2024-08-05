<?php

namespace App\Domains\Auth\Models\Traits\Attribute;

/**
 * Trait RoleAttribute.
 */
trait RoleAttribute
{
    /**
     * @return string
     */
    public function getPermissionsLabelAttribute(): string
    {
        if ($this->isAdmin()) {
            return 'Todos';
        }

        if (! $this->permissions->count()) {
            return 'Ninguno';
        }

        return collect($this->getPermissionDescriptions())
            ->implode('<br/>');
    }
}
