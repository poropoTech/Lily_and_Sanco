<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Department;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class DepartmentTableSeeder.
 */
class DepartmentSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        if (app()->environment(['local', 'testing'])) {
            $this->addTestDepartment(1);
            $this->addTestDepartment(2);
            $this->addTestDepartment(3);
            $this->addTestDepartment(4);
        }

        $this->enableForeignKeys();
    }

    private function addTestDepartment($number)
    {
        $department = Department::create([
            'name' => 'Departamento de prueba '.$number,
            'description' => 'Descripción de departamento de prueba '.$number,
            'order' => $number,
            'published' => true,
            'active' => true,
        ]);
    }
}
