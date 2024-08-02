<?php

namespace App\Domains\Structure\Http\Controllers\Frontend\Activity;

use App\Domains\Responses\Models\Response;
use App\Domains\Responses\Services\ResponseService;
use App\Domains\Statistics\Services\ViewService;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Services\ActivityService;
use App\Exceptions\GeneralException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class ActivityController.
 */
class ActivityController
{
    protected $activityService;
    protected $responseService;
    protected $viewService;

    public function __construct(ActivityService $activityService, ResponseService $responseService, ViewService $viewService)
    {
        $this->activityService = $activityService;
        $this->responseService = $responseService;
        $this->viewService = $viewService;
    }

    /**
     * @param Activity $activity
     * @return Factory|View
     */
    public function index(Activity $activity)
    {
        if (Auth::user()->isUser() && ! $activity->isPublished()) {
            return back()->withFlashDanger(__('La actividad no está publicada'));
        }

        $responsesPerPage = getSysSetting('app.activity.wall-responses-per-page');

        if (Auth::user()->isAdmin()) {
            $query = $activity->responses();
        } else {
            $query = $activity->responses()->onlyPublished();
        }

        $userCollectiveResponse = $activity->responses()
            ->challenge('collective')
            ->where('user_id', Auth::user()->id)
            ->first();

        $responses = $query->challenge('collective')
                                ->latest()
                                ->take($responsesPerPage)
                                ->get();

        $this->viewService->view($activity, Auth::user());

        return view('frontend.pages.activity')
            ->withActivity($activity)
            ->withUserCollectiveResponse($userCollectiveResponse)
            ->withResponses($responses);
    }

    public function new_response(Activity $activity, string $challenge)
    {
        if (! $activity->isPublished() || ! $activity->isActive()) {
            throw new GeneralException(__('La actividad no está publicada'));
        }

        return view($this->responseService->getResponseTypeFormView($activity->getResponseTypeByChallenge($challenge)))
            ->withActivity($activity)
            ->withChallenge($challenge);
    }
}
