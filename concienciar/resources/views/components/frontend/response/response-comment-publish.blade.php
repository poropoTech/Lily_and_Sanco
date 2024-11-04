@if($logged_in_user->can('admin.access.user-content.publish-comments'))
    <span class="response-comment-publish response-comment-actions response-comment-actions-publish" x-data-response-comment-publish-url="{{route('frontend.responses.comment.publish', ['comment' => $comment->id]) }}">
        @if ($comment->isPublished())
            <i class="fas fa-eye text-success" role="button"></i>
        @else
            <i class="fas fa-eye-slash text-danger" role="button"></i>
        @endif
    </span>
@endif
