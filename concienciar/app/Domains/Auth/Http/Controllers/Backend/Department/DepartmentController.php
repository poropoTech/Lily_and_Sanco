<?php

namespace App\Domains\Auth\Http\Controllers\Backend\Department;

use App\Domains\Auth\Http\Requests\Backend\Department\DeleteDepartmentRequest;
use App\Domains\Auth\Http\Requests\Backend\Department\EditDepartmentRequest;
use App\Domains\Auth\Http\Requests\Backend\Department\StoreDepartmentRequest;
use App\Domains\Auth\Http\Requests\Backend\Department\UpdateDepartmentRequest;
use App\Domains\Auth\Models\Department;
use App\Domains\Auth\Services\DepartmentService;

/**
 * Class DepartmentController.
 */
class DepartmentController
{
    /**
     * @var DepartmentService
     */
    protected $departmentService;

    /**
     * DepartmentController constructor.
     *
     * @param  DepartmentService  $departmentService
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.auth.department.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.auth.department.create');
    }

    /**
     * @param  StoreDepartmentRequest  $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreDepartmentRequest $request)
    {

        $this->departmentService->store($request->validated());

        return redirect()->route('admin.auth.department.index')->withFlashSuccess(__('El departamento ha sido creado.'));
    }

    /**
     * @param EditDepartmentRequest $request
     * @param Department $department
     * @return mixed
     */
    public function edit(EditDepartmentRequest $request, Department $department)
    {
        return view('backend.auth.department.edit')
            ->withDepartment($department);
    }
    /**
     * @param  UpdateDepartmentRequest  $request
     * @param  Department  $department
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $this->departmentService->update($department, $request->validated());

        return redirect()->route('admin.auth.department.index')->withFlashSuccess(__('El departamento ha sido modificado.'));
    }

    /**
     * @param  DeleteDepartmentRequest  $request
     * @param  Department  $department
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(DeleteDepartmentRequest $request, Department $department)
    {
        $this->departmentService->destroy($department);

        return redirect()->route('admin.auth.department.index')->withFlashSuccess(__('El departamento ha sido eliminado.'));
    }
}
