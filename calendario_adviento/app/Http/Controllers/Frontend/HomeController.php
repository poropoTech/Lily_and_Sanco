<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Configuration\System\Services\SystemConfigurationService;
use App\Domains\Responses\Models\Response;
use App\Domains\Responses\Services\ResponseService;
use App\Domains\Statistics\Services\StatisticsService;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Services\CategoryService;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController.
 */
class HomeController
{
    protected $categoryService;
    protected $responseService;
    protected $statisticsService;
    protected $configurationService;


    public function __construct(
        CategoryService $categoryService,
        ResponseService $responseService,
        StatisticsService $statisticsService,
        SystemConfigurationService $configurationService
    ) {
        $this->categoryService = $categoryService;
        $this->responseService = $responseService;
        $this->statisticsService = $statisticsService;
        $this->configurationService = $configurationService;
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $categoriesQuery = Category::query();
            $responsesQuery = Response::query();
        } else {
            $categoriesQuery = Category::onlyPublished();
            $responsesQuery = Response::onlyPublished();
        }

        $settings = $this->configurationService->getConfigSettings(['app.running.random-calendar']);
        if ($settings['app.running.random-calendar']) {
            $categories = $categoriesQuery->inRandomOrder()->get();
        } else {
            $categories = $categoriesQuery->orderBy('order')->get();
        }

        foreach ($categories as $category) {
            if($category->activities()->count() == 1) {
                $activityId = $category->activities()->first()->id;
                $category->uniqueActivityId = $activityId;
            }else{
                $category->uniqueActivityId = null;
            }
        }

        $responses = $responsesQuery->forCarousel()->challenge('collective')->get();
        $progress = $this->statisticsService->getTotal();
        $newActivities = $this->statisticsService->getNewActivities(Auth::user()->last_session_at);

        return view('frontend.pages.main')
            ->withCategories($categories)
            ->withNewActivities($newActivities)
            ->withCarouselResponses($responses)
            ->withProgress($progress);
    }
}
