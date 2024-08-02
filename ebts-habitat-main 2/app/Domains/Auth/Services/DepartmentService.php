<?php

namespace App\Domains\Auth\Services;

use App\Domains\Auth\Events\Department\DepartmentCreated;
use App\Domains\Auth\Events\Department\DepartmentDeleted;
use App\Domains\Auth\Events\Department\DepartmentUpdated;
use App\Domains\Auth\Models\Department;
use App\Exceptions\GeneralException;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class DepartmentService.
 */
class DepartmentService extends BaseService
{
    /**
     * DepartmentService constructor.
     *
     * @param  Department  $department
     */
    public function __construct(Department $department)
    {
        $this->model = $department;
    }

    /**
     * @param  array  $data
     *
     * @return Department
     * @throws GeneralException
     * @throws \Throwable
     */
    public function store(array $data = []): Department
    {
        DB::beginTransaction();

        try {
            $department = $this->model::create([
                'name' => $data['name'],
            ]);


        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema creando el departamento.'));
        }

        event(new DepartmentCreated($department));

        DB::commit();

        return $department;
    }

    /**
     * @param  Department  $department
     * @param  array  $data
     *
     * @return Department
     * @throws GeneralException
     * @throws \Throwable
     */
    public function update(Department $department, array $data = []): Department
    {
        DB::beginTransaction();

        try {
            $department->update([
                'name' => $data['name'],
            ]);


        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('Hubo un problema actualizando el departamento.'));
        }

        event(new DepartmentUpdated($department));

        DB::commit();

        return $department;
    }

    /**
     * @param  Department  $department
     *
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Department $department): bool
    {
        if ($department->users()->count()) {
            throw new GeneralException(__('No se puede eliminar un departamento con usuarios asociados'));
        }

        if ($this->deleteById($department->id)) {
            event(new DepartmentDeleted($department));

            return true;
        }

        throw new GeneralException(__('Hubo un problema eliminando el departamento.'));
    }
}
