<?php

namespace App\Domains\Structure\Http\Controllers\Backend\Activity;

use App\Domains\Responses\Services\ResponseService;
use App\Domains\Structure\Http\Requests\Backend\Activity\CopyActivityRequest;
use App\Domains\Structure\Http\Requests\Backend\Activity\DeleteActivityRequest;
use App\Domains\Structure\Http\Requests\Backend\Activity\EditActivityRequest;
use App\Domains\Structure\Http\Requests\Backend\Activity\StoreActivityRequest;
use App\Domains\Structure\Http\Requests\Backend\Activity\UpdateActivityRequest;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Services\ActivityService;
use App\Domains\Structure\Services\CategoryService;

/**
 * Class ActivityController.
 */
class ActivityController
{
    protected $activityService;
    protected $categoryService;
    protected $responseService;

    public function __construct(ActivityService $activityService, CategoryService $categoryService, ResponseService $responseService)
    {
        $this->activityService = $activityService;
        $this->categoryService = $categoryService;
        $this->responseService = $responseService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.structure.activity.index');
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.structure.activity.create')
            ->withCategories($this->categoryService->all())
            ->withResponseTypes($this->responseService->getTypes());
    }

    /**
     * @param  StoreActivityRequest  $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreActivityRequest $request)
    {
        $this->activityService->store($request->validated());

        return redirect()->route('admin.structure.activity.index')->withFlashSuccess(__('La actividad ha sido creada.'));
    }

    /**
     * @param EditActivityRequest $request
     * @param Activity $activity
     * @return mixed
     */
    public function edit(EditActivityRequest $request, Activity $activity)
    {
        return view('backend.structure.activity.edit')
            ->withActivity($activity)
            ->withCategories($this->categoryService->all())
            ->withResponseTypes($this->responseService->getTypes());
    }

    /**
     * @param CopyActivityRequest $request
     * @param Activity $activity
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function copy(CopyActivityRequest $request, Activity $activity)
    {
        $copiedActivity = $this->activityService->copy($activity);

        return redirect()->route('admin.structure.activity.index')->withFlashSuccess(__('La actividad ha sido copiada.'));

    }

    /**
     * @param  UpdateActivityRequest  $request
     * @param  Activity  $activity
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        $this->activityService->update($activity, $request->validated());

        return redirect()->route('admin.structure.activity.index')->withFlashSuccess(__('La actividad ha sido modificada.'));
    }

    /**
     * @param  DeleteActivityRequest  $request
     * @param  Activity  $activity
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(DeleteActivityRequest $request, Activity $activity)
    {
        $this->activityService->destroy($activity);

        return redirect()->route('admin.structure.activity.index')->withFlashSuccess(__('La actividad ha sido eliminada.'));
    }
}
