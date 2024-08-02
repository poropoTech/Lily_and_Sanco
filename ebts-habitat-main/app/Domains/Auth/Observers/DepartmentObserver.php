<?php

namespace App\Domains\Auth\Observers;

use App\Domains\Auth\Models\Department;
use Illuminate\Support\Str;

class DepartmentObserver
{

    public function updating(Department $department): void
    {
        $this->generateSlug($department);
    }


    public function creating(Department $department): void
    {
        $this->generateSlug($department);
    }

    private function generateSlug(Department $department): void
    {
        $subfix = 1;

        if (Department::where('slug', Str::slug($department->name, '-'))->exists()) {
            while (Department::where('slug', Str::slug($department->name . ' ' . $subfix, '-'))->exists()) {
                $subfix++;
            }
            $department->slug = Str::slug($department->name . ' ' . $subfix, '-');
        } else {
            $department->slug = Str::slug($department->name, '-');
        }
    }
}
