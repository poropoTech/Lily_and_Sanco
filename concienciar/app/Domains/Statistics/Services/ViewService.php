<?php

namespace App\Domains\Statistics\Services;

use App\Domains\Auth\Models\User;
use App\Domains\Statistics\Events\ViewCreated;
use App\Domains\Statistics\Models\View;
use App\Domains\Structure\Models\Activity;

/**
 * Class ViewService.
 */
class ViewService
{
    public function __construct()
    {
    }

    public function view(Activity $activity, User $user): ?View
    {
        $views = View::where('activity_id', $activity->id)->where('user_id', $user->id)->count();

        if (! $views) {
            $view = new View();
            $view->user_id = $user->id;
            $view->activity_id = $activity->id;
            $view->save();

            event(new ViewCreated($view));

            return $view;
        }

        return null;
    }
}
