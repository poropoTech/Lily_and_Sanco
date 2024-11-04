<?php

namespace App\Domains\Structure\Events\Activity;

use App\Domains\Structure\Models\Activity;
use Illuminate\Queue\SerializesModels;

/**
 * Class ActivityUpdated.
 */
class ActivityUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $activity;

    /**
     * @param $activity
     */
    public function __construct(Activity $activity)
    {
        $this->activity = $activity;
    }
}
