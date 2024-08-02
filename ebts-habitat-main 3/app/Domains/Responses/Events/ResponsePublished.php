<?php

namespace App\Domains\Responses\Events;

use App\Domains\Responses\Models\Response;
use Illuminate\Queue\SerializesModels;

/**
 * Class ResponsePublished.
 */
class ResponsePublished
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
