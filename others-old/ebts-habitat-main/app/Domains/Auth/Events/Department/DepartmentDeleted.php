<?php

namespace App\Domains\Auth\Events\Department;

use App\Domains\Auth\Models\Department;
use Illuminate\Queue\SerializesModels;

/**
 * Class DepartmentDeleted.
 */
class DepartmentDeleted
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
