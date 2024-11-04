<?php

namespace App\Domains\Auth\Events\Department;

use App\Domains\Auth\Models\Department;
use Illuminate\Queue\SerializesModels;

/**
 * Class DepartmentUpdated.
 */
class DepartmentUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $department;

    /**
     * @param $department
     */
    public function __construct(Department $department)
    {
        $this->department = $department;
    }
}
