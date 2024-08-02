@if($logged_in_user->can('admin.access.user-content.delete-comments') || $logged_in_user->id == $comment->user->id)
    <span class="response-comment-delete response-comment-actions response-comment-actions-delete" x-data-response-comment-delete-url="{{route('frontend.responses.comment.delete', ['comment' => $comment->id]) }}">
        <i class="fas fa-trash text-dark" role="button"></i>
    </span>
@endif
