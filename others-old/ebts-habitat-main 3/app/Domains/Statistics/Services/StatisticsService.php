<?php

namespace App\Domains\Statistics\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Domains\Responses\Models\Response;
use App\Domains\Responses\Services\ResponseService;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Services\ActivityService;
use App\Domains\Structure\Services\CategoryService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

/**
 * Class StatisticsService.
 */
class StatisticsService
{
    protected $userService;
    protected $categoryService;
    protected $activityService;
    protected $responseService;

    public function __construct(
        UserService $userService,
        CategoryService $categoryService,
        ActivityService $activityService,
        ResponseService $responseService
    ) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->activityService = $activityService;
        $this->responseService = $responseService;
    }

    public function getTotal()
    {
        $responses = Response::forStats()->groupBy(['users.id', 'activities.id'])->select(['users.id', 'activities.id'])->get()->count();
        $activities = Activity::forStats()->count();
        $users = User::forStats()->count();


        if (! $activities || ! $responses) {
            return ['progress' => 0, 'image' => URL::asset('img/progress/progress0.svg'), 'step' => 0];
        }

        $progress = round(($responses * 100) / ($users * $activities));
        $progress = $progress > 100 ? 100 : $progress;

        $image = $this->getStatImage($progress);

        return ['progress' => $progress, 'image' => $image['image'], 'step' => $image['step']];
    }

    protected function getStatImage(int $percent)
    {
        $images = [
            ['value' => 0, 'image' => URL::asset('img/progress/progress0.svg'), 'step' => 0],
            ['value' => 15, 'image' => URL::asset('img/progress/progress25.svg'), 'step' => 1],
            ['value' => 25, 'image' => URL::asset('img/progress/progress25.svg'), 'step' => 2],
            ['value' => 50, 'image' => URL::asset('img/progress/progress50.svg'), 'step' => 2],
            ['value' => 75, 'image' => URL::asset('img/progress/progress75.svg'), 'step' => 3],
            ['value' => 100, 'image' => URL::asset('img/progress/progress100.svg'), 'step' => 4],
        ];

        if ($percent == 100) {
            return ['image' => URL::asset('img/progress/progress100.svg'), 'step' => 4];
        }


        foreach ($images as $key => $value) {
            if ($percent < $value['value']) {
                return ['image' => $images[$key - 1]['image'], 'step' => $images[$key - 1]['step']];
            }
        }
    }

    public function getTotalByUser(User $user, string $challenge = null)
    {
        $responsesQuery = $user->responses()->forStats();
        $activities = Activity::forStats()->count();

        if (! is_null($challenge)) {
            $responses = $responsesQuery->challenge($challenge)->count();
        } else {
            $responses = $responsesQuery->count();
            $activities *= 2;
        }

        $progress = round(($responses * 100) / $activities);
        $progress = $progress > 100 ? 100 : $progress;

        return ['progress' => $progress];
    }

    public function getUserCategoryStats(User $user, string $challenge = null)
    {
        $totals = DB::select(
            'select c2.id as id, IFNULL(c3.count,0) as count from categories c2 left join
                            (select c.id as id, count(c.id) as count from categories c left join activities a on c.id = a.category_id
                            where a.published and c.published
                            group by c.id) as c3 on c2.id = c3.id order by c2.id'
        );

        if (is_null($challenge)) {
            $notCompleted = DB::select(
                'select c2.id as id, IFNULL(c3.count,0) as count from categories c2 left join
                            (select c.id, count(c.id) as count from categories c
                            inner join activities a on c.id = a.category_id
                            where a.published and c.published and a.id not in (select activity_id from responses r
                            where user_id = :user group by activity_id having count(*) = 2)
                            group by c.id) as c3 on c2.id = c3.id order by c2.id',
                ['user' => $user->id]
            );
        } else {
            $notCompleted = DB::select(
                'select c2.id as id, IFNULL(c3.count,0) as count from categories c2 left join
                            (select c.id, count(c.id) as count from categories c
                            inner join activities a on c.id = a.category_id
                            where a.published and c.published and a.id not in (select activity_id from responses r
                            where user_id = :user and challenge = :challenge)
                            group by c.id) as c3 on c2.id = c3.id order by c2.id',
                ['user' => $user->id, 'challenge' => $challenge]
            );
        }

        $stats = [];

        foreach ($totals as $key => $value) {
            $totalActivities = $value->count;
            $notCompletedActivities = $notCompleted[$key]->count;

            if ($totalActivities) {
                $ratio = round(($notCompletedActivities * 100) / $totalActivities);
            } else {
                $ratio = 0;
            }

            $stats[$value->id] = ['totalActivities' => $totalActivities, 'notCompleted' => $notCompletedActivities, 'notCompletedRatio' => $ratio ];
        }

        return $stats;
    }

    public function getNewActivities(?\DateTime $since)
    {
        if (is_null($since)) {
            $since = Carbon::minValue();
        }

        $totals = DB::select(
            'select c2.id as id, IFNULL(c3.count,0) as count from categories c2 left join
                            (select c.id as id, count(c.id) as count from categories c left join activities a on c.id = a.category_id
                            where a.published and c.published and a.created_at > :since
                            group by c.id) as c3 on c2.id = c3.id order by c2.id',
            ['since' => $since]
        );

        $stats = [];
        foreach ($totals as $key => $value) {
            $stats[$value->id] = ['newActivities' => $value->count];
        }

        return $stats;
    }
}
