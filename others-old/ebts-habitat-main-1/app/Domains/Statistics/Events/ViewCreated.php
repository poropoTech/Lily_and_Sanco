<?php

namespace App\Domains\Statistics\Events;

use App\Domains\Statistics\Models\View;
use Illuminate\Queue\SerializesModels;

/**
 * Class ViewCreated.
 */
class ViewCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $view;

    /**
     * @param $view
     */
    public function __construct(View $view)
    {
        $this->view = $view;
    }
}
