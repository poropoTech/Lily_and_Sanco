<?php

namespace App\Domains\Structure\Http\Controllers\Frontend\Category;

use App\Domains\Statistics\Services\StatisticsService;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Services\ActivityService;
use App\Domains\Structure\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class CategoryController.
 */
class CategoryController
{
    protected $categoryService;
    protected $activityService;
    protected $statisticsService;

    public function __construct(
        CategoryService $categoryService,
        ActivityService $activityService,
        StatisticsService $statisticsService
    ) {
        $this->categoryService = $categoryService;
        $this->activityService = $activityService;
        $this->statisticsService = $statisticsService;
    }

    public function index()
    {
        if (Auth::user()->isAdmin()) {
            $categoriesQuery = Category::query();
            $activitiesQuery = Activity::query();
        } else {
            $categoriesQuery = Category::onlyPublished();
            $activitiesQuery = Activity::onlyPublished();
        }

        $categories = $categoriesQuery->orderBy('order')->get();
        $newActivities = $this->statisticsService->getNewActivities(Auth::user()->last_session_at);

        $activitiesPerPage = getSysSetting('app.category.wall-activities-per-page');

        $activities = $activitiesQuery
            ->orderBy('order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->take($activitiesPerPage)
            ->get();

        return view('frontend.pages.categories')
            ->withCategories($categories)
            ->withNewActivities($newActivities)
            ->withActivities($activities);
    }

    /**
     * @param Category $category
     * @return Factory|View
     */
    public function category(Category $category)
    {
        if (Auth::user()->isUser() && ! $category->isPublished()) {
            return back()->withFlashDanger(__('La categoría no está publicada'));
        }

        if (Auth::user()->isUser() && ! $category->isActive()) {
            return back()->withFlashDanger(__('La categoría no está activa'));
        }

        $activitiesPerPage = getSysSetting('app.category.wall-activities-per-page');

        if (Auth::user()->isAdmin()) {
            $query = $category->activities();
        } else {
            $query = $category->activities()->onlyPublished();
        }

        $activities = $query
            ->orderBy('order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->take($activitiesPerPage)
            ->get();

        return view('frontend.pages.category')
            ->withCategory($category)
            ->withActivities($activities);
    }
}
