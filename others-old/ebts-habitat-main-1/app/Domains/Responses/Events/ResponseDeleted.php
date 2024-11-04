<?php

namespace App\Domains\Responses\Events;

use App\Domains\Responses\Models\Response;
use Illuminate\Queue\SerializesModels;

/**
 * Class ResponseDeleted.
 */
class ResponseDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $response;

    /**
     * @param $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}
