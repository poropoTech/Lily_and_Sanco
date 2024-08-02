<?php

namespace App\Domains\Configuration\System\Http\Controllers\Backend\App;

use App\Domains\Configuration\System\Http\Requests\Backend\App\Notifications\IndexNotificationsRequest;
use App\Domains\Configuration\System\Http\Requests\Backend\App\Notifications\UpdateNotificationsRequest;
use App\Domains\Configuration\System\Http\Requests\Backend\App\Statistics\IndexGeneralStatisticsRequest;
use App\Domains\Configuration\System\Services\SystemConfigurationService;
use App\Domains\Statistics\Services\StatisticsService;

/**
 * Class GeneralStatisticsController.
 */
class GeneralStatisticsController
{
    /**
     * @var StatisticsService
     */
    protected $statisticsService;

    /**
     * GeneralStatisticsController constructor.
     *
     * @param  StatisticsService  $statisticsService
     */
    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index(IndexGeneralStatisticsRequest $request)
    {
        $data = $this->statisticsService->getAdminStats();


        return view('backend.statistics.general')->withData($data);
    }

}
