<?php

namespace App\Domains\Responses\Http\Controllers\Frontend;

use App\Domains\Responses\Http\Requests\Frontend\Response\GetResponseFeedRequest;
use App\Domains\Responses\Models\Response as ResponseModel;
use App\Domains\Responses\Services\ResponseService;
use App\Domains\Structure\Models\Activity;
use Illuminate\Support\Facades\Auth;

/**
 * Class ResponseFeedController.
 */
class ResponseFeedController
{
    /**
     * @var ResponseService
     */
    protected $responseService;

    /**
     * ResponseController constructor.
     *
     * @param  ResponseService  $responseService
     */
    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }

    public function global_wall_feed(GetResponseFeedRequest $request)
    {
        $responsesPerPage = getSysSetting('app.wall.responses-per-page');

        $page = $request->input('page');

        if (Auth::user()->isAdmin()) {
            $query = ResponseModel::query();
        } else {
            $query = ResponseModel::onlyPublished();
        }

        $result = $query->challenge('collective')
            ->latest()
            ->skip(($page - 1) * $responsesPerPage)
            ->take($responsesPerPage)
            ->get();

        return view('components.frontend.response.feeds.responses-feed')
            ->withResponses($result)
            ->withItemsPerPage($responsesPerPage);
    }

    public function activity_wall_feed(GetResponseFeedRequest $request, Activity $activity)
    {
        $responsesPerPage = getSysSetting('app.activity.wall-responses-per-page');

        $page = $request->input('page');

        if (Auth::user()->isAdmin()) {
            $query = $activity->responses();
        } else {
            $query = $activity->responses()->onlyPublished();
        }

        $result = $query->challenge('collective')
            ->latest()
            ->skip(($page - 1) * $responsesPerPage)
            ->take($responsesPerPage)
            ->get();

        return view('components.frontend.response.feeds.responses-feed')
            ->withResponses($result)
            ->withItemsPerPage($responsesPerPage);
    }
}
