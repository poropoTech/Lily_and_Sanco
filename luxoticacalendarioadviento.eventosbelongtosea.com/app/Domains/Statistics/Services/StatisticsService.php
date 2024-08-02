<?php

namespace App\Domains\Statistics\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Domains\Configuration\System\Services\SystemConfigurationService;
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
    protected $systemConfigurationService;

    public function __construct(
        UserService $userService,
        CategoryService $categoryService,
        ActivityService $activityService,
        ResponseService $responseService,
        SystemConfigurationService $systemConfigurationService
    ) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->activityService = $activityService;
        $this->responseService = $responseService;
        $this->systemConfigurationService = $systemConfigurationService;
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

        $image = $this->getStatImage($progress);

        return ['progress' => $this->adjustProgress($progress), 'image' => $image['image'], 'step' => $image['step']];
    }

    protected function adjustProgress(int $progress): int
    {
        $settings = $this->systemConfigurationService->getConfigSettings(
            [
                'app.running.progress-mode',
                'app.running.progress-value',
            ]
        );

        switch($settings['app.running.progress-mode']) {
            case 'mul':
                $progress = round($progress * $settings['app.running.progress-value']);
                break;
            case 'sum':
                $progress = round($progress + $settings['app.running.progress-value']);
                break;
            case 'abs':
                $progress = round($settings['app.running.progress-value']);
                break;

        }

        return $progress > 100 ? 100 : ($progress < 0 ? 0 : $progress);
    }

    protected function getStatImage(int $percent)
    {
        $images = [
            ['value' => 0, 'image' => URL::asset('img/progress/progress0.svg'), 'step' => 0],
            ['value' => 20, 'image' => URL::asset('img/progress/progress20.svg'), 'step' => 1],
            ['value' => 40, 'image' => URL::asset('img/progress/progress40.svg'), 'step' => 2],
            ['value' => 60, 'image' => URL::asset('img/progress/progress60.svg'), 'step' => 2],
            ['value' => 80, 'image' => URL::asset('img/progress/progress80.svg'), 'step' => 3],
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

    public function getAdminStats(): array
    {
        $baseQuery = 'select u.id as user_id, u.name as user_name, IFNULL(sub2.completed,0) as completed, (SELECT count(*) from categories c
                    inner join activities a on c.id = a.category_id
                    where a.published and c.published) as total from users u left join (
                    select sub.user_id as user_id, count(*) as completed from (
                    select user_id, activity_id
                    from responses r
                    inner join activities a on a.id = r.activity_id
                    inner join categories c on c.id = a.category_id
                    where a.published and c.published
                    group by user_id, activity_id having count(*) > 0
                    ) as sub GROUP by sub.user_id) as sub2 on u.id = sub2.user_id
                    where u.`type` = "user" and u.deleted_at is null ';

        $totalUsers = User::where('type', 'user')->count();

        $noActivitiesList = DB::select($baseQuery.' and IFNULL(sub2.completed,0) = 0');
        $noActivitiesCount = count($noActivitiesList);
        $completedActivitiesList = DB::select($baseQuery.' and sub2.completed = (SELECT count(*) from categories c
                                                                    inner join activities a on c.id = a.category_id
                                                                    where a.published and c.published)'
        );
        $completedActivitiesCount = count($completedActivitiesList);
        $anyActivitiesList = DB::select($baseQuery.' and IFNULL(sub2.completed,0) > 0 order by sub2.completed desc');
        $anyActivitiesCount = count($anyActivitiesList);

        $wallPostsCount = DB::select('select count(*) as cuenta from responses r inner join users u on r.user_id = u.id
                                            inner join activities a on a.id = r.activity_id
                                            inner join categories c on c.id = a.category_id
                                            where a.published and c.published and r.published and u.deleted_at is null
                                            and u.`type` = "user" and r.challenge ="collective"'

        )[0]->cuenta;

        $usersPostedInWallCount = count(DB::select('select distinct u.id as user_id from responses r inner join users u on r.user_id = u.id
                                            inner join activities a on a.id = r.activity_id
                                            inner join categories c on c.id = a.category_id
                                            where a.published and c.published and r.published and u.deleted_at is null
                                            and u.`type` = "user" and r.challenge ="collective"')

        );

        $activitiesRanking = DB::select('select sub.activity_id as activity_id, sub.title as title, count(*) as users from (
                                            select user_id, activity_id, a.title as title
                                            from responses r
                                            inner join users u on u.id = r.user_id
                                            inner join activities a on a.id = r.activity_id
                                            inner join categories c on c.id = a.category_id
                                            where a.published and c.published and r.published and u.deleted_at is null and u.`type` = "user"
                                            group by user_id, activity_id, a.title having count(*) > 0
                                            ) as sub GROUP by sub.activity_id, sub.title order by users desc'
        );

        $userRanking = DB::select('select u.id as user_id, u.name as name, count(*) as challenges
                                        from responses r
                                        inner join users u on u.id = r.user_id
                                        inner join activities a on a.id = r.activity_id
                                        inner join categories c on c.id = a.category_id
                                        where a.published and c.published and r.published and u.deleted_at is null and u.`type` = "user"
                                        group by u.id, u.name order by challenges desc'
        );

        return [
            'totalUsers' => $totalUsers,
            'noActivitiesList' => $noActivitiesList,
            'noActivitiesCount' => $noActivitiesCount,
            'completedActivitiesList' => $completedActivitiesList,
            'completedActivitiesCount' => $completedActivitiesCount,
            'anyActivitiesList' => $anyActivitiesList,
            'anyActivitiesCount' => $anyActivitiesCount,
            'wallPostsCount' => $wallPostsCount,
            'usersPostedInWallCount' => $usersPostedInWallCount,
            'activitiesRanking' => $activitiesRanking,
            'userRanking' => $userRanking,

        ];
    }


}
