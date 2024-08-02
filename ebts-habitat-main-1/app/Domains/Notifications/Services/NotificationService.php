<?php

namespace App\Domains\Notifications\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\UserService;
use App\Domains\Common\Models\Comment;
use App\Domains\Notifications\Models\UserNotification;
use App\Domains\Responses\Notifications\Frontend\NewResponseCommentNotification;
use App\Domains\Responses\Services\ResponseService;
use App\Domains\Statistics\Notifications\IncompleteActivitiesNotification;
use App\Domains\Statistics\Services\StatisticsService;
use App\Domains\Structure\Models\Activity;
use App\Domains\Structure\Notifications\Frontend\ActivityPublishedNotification;
use App\Domains\Structure\Services\ActivityService;
use App\Domains\Structure\Services\CategoryService;

/**
 * Class NotificationService.
 */
class NotificationService
{
    protected $userService;
    protected $categoryService;
    protected $activityService;
    protected $responseService;
    protected $statsService;

    public function __construct(
        UserService $userService,
        CategoryService $categoryService,
        ActivityService $activityService,
        ResponseService $responseService,
        StatisticsService $statsService
    ) {
        $this->userService = $userService;
        $this->categoryService = $categoryService;
        $this->activityService = $activityService;
        $this->responseService = $responseService;
        $this->statsService = $statsService;
    }

    public function activityPublished(Activity $activity)
    {
        if (getSysSetting('app.notifications.activity-published') == false) {
            return;
        }

        $users = User::users()->onlyActive()->get();

        foreach ($users as $user) {
            if ($this->userWantsNotification($user, ActivityPublishedNotification::class)) {
                $user->notify(new ActivityPublishedNotification($activity));
            }
        }
    }

    public function incompleteActivityRemainder()
    {
        if (getSysSetting('app.notifications.incomplete-activities') == false) {
            return;
        }

        $users = User::users()->onlyActive()->get();

        foreach ($users as $user) {
            if ($this->userWantsNotification($user, IncompleteActivitiesNotification::class)) {
                $stats = $this->statsService->getTotalByUser($user);
                if ($stats['progress'] < 100) {
                    $user->notify(new IncompleteActivitiesNotification($stats));
                }
            }
        }
    }

    public function newResponseComment(Comment $comment)
    {
        $response = $comment->owner;
        $user = $response->user;

        if (getSysSetting('app.notifications.new-response-comment') == false) {
            return;
        }

        if ($comment->user_id == $response->user_id) {
            return;
        }

        if ($this->userWantsNotification($user, NewResponseCommentNotification::class)) {
            $user->notify(new NewResponseCommentNotification($comment));
        }
    }

    protected function userWantsNotification(User $user, string $notificationName): bool
    {
        $userNotification = UserNotification::where('user_id', $user->id)
            ->where('name', $notificationName)
            ->first();

        if (getSysSetting('app.notifications.opt-in') == false) {
            return is_null($userNotification);
        } else {
            return ! is_null($userNotification);
        }
    }
}
