<?php

namespace App\Domains\Responses\Http\Controllers\Frontend;

use App\Domains\Responses\Http\Requests\Frontend\Response\DeleteResponseRequest;
use App\Domains\Responses\Http\Requests\Frontend\Response\PublishResponseRequest;
use App\Domains\Responses\Http\Requests\Frontend\Response\StoreResponseRequest;
use App\Domains\Responses\Models\Response as ResponseModel;
use App\Domains\Responses\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class ResponseController.
 */
class ResponseController
{
    /**
     * @var ResponseService
     */
    protected $responseService;

    /**
     * ResponseController constructor.
     *
     * @param  ResponseService  $responseService
     */
    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }


    public function store(StoreResponseRequest $request)
    {
        $data = $request->validated();

        $this->responseService->store(array_merge($data, ['user_id' => $request->user()->id]));

        return Response::json(['message' => 'Ok']);
    }


    public function like(Request $request, ResponseModel $response)
    {
        if ($response->isLiked()) {
            $response->dislike();

            return Response::json('', 204);
        }
        $response->like();

        return Response::json('', 201);
    }

    public function publish(PublishResponseRequest $request, ResponseModel $response)
    {
        if ($response->isPublished()) {
            $this->responseService->unpublish($response);

            return Response::json('NotPublished', 200);
        } else {
            $this->responseService->publish($response);

            return Response::json('Published', 200);
        }
    }

    public function delete(DeleteResponseRequest $request, ResponseModel $response)
    {
        $this->responseService->destroy($response);

        return Response::json('Deleted', 200);
    }
}
