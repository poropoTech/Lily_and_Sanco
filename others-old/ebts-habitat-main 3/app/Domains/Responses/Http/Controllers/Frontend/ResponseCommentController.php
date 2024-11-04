<?php

namespace App\Domains\Responses\Http\Controllers\Frontend;

use App\Domains\Common\Models\Comment;
use App\Domains\Common\Services\CommentService;
use App\Domains\Responses\Http\Requests\Frontend\Response\DeleteResponseCommentRequest;
use App\Domains\Responses\Http\Requests\Frontend\Response\GetResponseCommentFeedRequest;
use App\Domains\Responses\Http\Requests\Frontend\Response\PublishResponseCommentRequest;
use App\Domains\Responses\Http\Requests\Frontend\Response\StoreResponseCommentRequest;
use App\Domains\Responses\Models\Response as ResponseModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

/**
 * Class ResponseCommentController.
 */
class ResponseCommentController
{
    /**
     * @var CommentService
     */
    protected $commentService;

    /**
     * ResponseCommentController constructor.
     *
     * @param  CommentService  $commentService
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function feed(GetResponseCommentFeedRequest $request, ResponseModel $response)
    {
        $commentsPerPage = getSysSetting('app.responses.wall-comments-per-page');

        $page = $request->input('page');

        if (Auth::user()->isAdmin()) {
            $query = $response->comments();
        } else {
            $query = $response->comments()->onlyPublished();
        }

        $result = $query->with('user')
            ->latest('comments.created_at')
            ->skip(($page - 1) * $commentsPerPage)
            ->take($commentsPerPage)
            ->get();

        if ($request->has('view')) {
            switch ($request->input('view')) {
                case 'inline':
                    return view('components.frontend.response.feeds.comment-inline-feed')->withComments($result);
                default:
                    return view('components.frontend.response.feeds.comment-feed')->withComments($result);
            }
        }

        return view('components.frontend.response.feeds.comment-feed')->withComments($result);
    }

    public function store(StoreResponseCommentRequest $request, ResponseModel $response)
    {
        $data = $request->validated();
        $authUser = Auth::user();

        $this->commentService->store($authUser, $response, $data);

        return Response::json(['message' => 'Ok']);
    }

    public function publish(PublishResponseCommentRequest $request, Comment $comment)
    {
        if ($comment->isPublished()) {
            $this->commentService->unpublish($comment);

            return Response::json('NotPublished', 200);
        } else {
            $this->commentService->publish($comment);

            return Response::json('Published', 200);
        }
    }

    public function delete(DeleteResponseCommentRequest $request, Comment $comment)
    {
        $this->commentService->destroy($comment);

        return Response::json('Deleted', 200);
    }
}
