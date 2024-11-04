<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Responses\Models\Response;
use App\Domains\Responses\Services\ResponseService;
use App\Domains\Statistics\Services\StatisticsService;

/**
 * Class WallController.
 */
class WallController
{
    protected $responseService;
    protected $statisticsService;


    public function __construct(ResponseService $responseService, StatisticsService $statisticsService)
    {
        $this->responseService = $responseService;
        $this->statisticsService = $statisticsService;
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $responsesPerPage = getSysSetting('app.wall.responses-per-page');
        $responses = Response::onlyPublished()->challenge('collective')
            ->latest()
            ->take($responsesPerPage)
            ->get();
        $progress = $this->statisticsService->getTotal();

        return view('frontend.pages.wall')
            ->withResponses($responses)
            ->withProgress($progress);
    }
}
