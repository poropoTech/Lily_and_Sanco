<?php

namespace App\Http\Controllers\Frontend;

use App\Domains\Responses\Models\Response;
use App\Domains\Responses\Services\ResponseService;
use App\Domains\Statistics\Services\StatisticsService;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Services\CategoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

/**
 * Class HomeController.
 */
class HomeController
{
    protected $categoryService;
    protected $responseService;
    protected $statisticsService;


    public function __construct(CategoryService $categoryService, ResponseService $responseService, StatisticsService $statisticsService)
    {
        $this->categoryService = $categoryService;
        $this->responseService = $responseService;
        $this->statisticsService = $statisticsService;
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
        $categories = $categoriesQuery->orderBy('order')->get();
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
