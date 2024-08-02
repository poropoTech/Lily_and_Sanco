<?php

namespace App\Domains\Structure\Http\Controllers\Frontend\Activity;

use App\Domains\Structure\Http\Requests\Frontend\Category\GetActivityFeedRequest;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Models\Category;
use App\Domains\Structure\Services\ActivityService;
use Illuminate\Support\Facades\Auth;

/**
 * Class ActivityFeedController.
 */
class ActivityFeedController
{
    protected $activityService;

    public function __construct(ActivityService $activityService)
    {
        $this->activityService = $activityService;
    }

    public function category_wall_feed(GetActivityFeedRequest $request, Category $category)
    {
        $activitiesPerPage = getSysSetting('app.category.wall-activities-per-page');

        $page = $request->input('page');

        if (Auth::user()->isAdmin()) {
            $query = $category->activities();
        } else {
            $query = $category->activities()->onlyPublished();
        }

        $result = $query
            ->orderBy('order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->skip(($page - 1) * $activitiesPerPage)
            ->take($activitiesPerPage)
            ->get();

        return view('components.frontend.activity.feeds.activities-feed')->withActivities($result);
    }

    public function categories_wall_feed(GetActivityFeedRequest $request)
    {
        $activitiesPerPage = getSysSetting('app.category.wall-activities-per-page');

        $page = $request->input('page');

        if (Auth::user()->isAdmin()) {
            $query = Activity::query();
        } else {
            $query = Activity::onlyPublished();
        }

        $result = $query
            ->orderBy('order', 'ASC')
            ->orderBy('created_at', 'DESC')
            ->skip(($page - 1) * $activitiesPerPage)
            ->take($activitiesPerPage)
            ->get();

        return view('components.frontend.activity.feeds.activities-feed')->withActivities($result);
    }

    public function user_incomplete_wall_feed(GetActivityFeedRequest $request)
    {
        $activitiesPerPage = getSysSetting('app.category.wall-activities-per-page');

        $page = $request->input('page');

        $doneActivities = Auth::user()->responses()->forStats()
            ->select('activity_id')
            ->groupBy('activity_id')
            ->havingRaw('COUNT(responses.activity_id) = 2')
            ->get()
            ->pluck('activity_id');

        $result = Activity::forStats()
            ->whereNotIn('activities.id', $doneActivities)
            ->select('activities.*')
            ->latest('activities.created_at')
            ->skip(($page - 1) * $activitiesPerPage)
            ->take($activitiesPerPage)
            ->get();

        return view('components.frontend.activity.feeds.activities-feed')->withActivities($result);
    }
}
