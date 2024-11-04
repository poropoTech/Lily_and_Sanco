<?php

namespace App\Http\Controllers\Frontend\User;

use App\Domains\Statistics\Services\StatisticsService;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Services\CategoryService;
use Illuminate\Support\Facades\Auth;

class ChallengesController
{
    protected $statsService;
    protected $categoryService;

    /**
     * ChallengesController constructor.
     * @param $statsService
     * @param $categoryService
     */
    public function __construct(StatisticsService $statsService, CategoryService $categoryService)
    {
        $this->statsService = $statsService;
        $this->categoryService = $categoryService;
    }


    public function index()
    {
        $activitiesPerPage = getSysSetting('app.category.wall-activities-per-page');

        $doneActivities = Auth::user()->responses()->forStats()
            ->select('activity_id')
            ->groupBy('activity_id')
            ->havingRaw('COUNT(responses.activity_id) = 2')
            ->get()
            ->pluck('activity_id');

        $activities = Activity::forStats()
            ->whereNotIn('activities.id', $doneActivities)
            ->select('activities.*')
            ->latest('activities.created_at')
            ->take($activitiesPerPage)
            ->get();

        $categories = Category::onlyPublished()->get();
        $stats = $this->statsService->getUserCategoryStats(Auth::user());

        return view('frontend.user.challenges')
            ->withActivities($activities)
            ->withCategories($categories)
            ->withStats($stats);
    }
}
