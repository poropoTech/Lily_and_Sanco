<?php

namespace App\Domains\Statistics\Http\Controllers\Frontend;

use App\Domains\Statistics\Services\StatisticsService;

/**
 * Class ProgressController.
 */
class ProgressController
{

    protected $statisticsService;


    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }


    public function index()
    {
        $value = $this->statisticsService->getTotal();

        return view('frontend.pages.progress')
            ->withProgress($value);
    }
}
