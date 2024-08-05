<?php

namespace App\Domains\Structure\Observers;

use App\Domains\Structure\Models\Activity;
use Illuminate\Support\Str;

class ActivityObserver
{

    public function updating(Activity $activity): void
    {
        $this->generateSlug($activity);
    }


    public function creating(Activity $activity): void
    {
        $this->generateSlug($activity);
    }

    private function generateSlug(Activity $activity): void
    {
        $subfix = 1;

        if (Activity::where('slug', Str::slug($activity->title, '-'))->exists()) {
            while (Activity::where('slug', Str::slug($activity->title . ' ' . $subfix, '-'))->exists()) {
                $subfix++;
            }
            $activity->slug = Str::slug($activity->title . ' ' . $subfix, '-');
        } else {
            $activity->slug = Str::slug($activity->title, '-');
        }
    }
}
