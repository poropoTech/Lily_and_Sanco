@if($logged_in_user->can('admin.access.user-content.publish-responses'))
    <span class="response-publish response-card-actions response-card-actions-publish" x-data-response-publish-url="{{route('frontend.responses.publish', ['response' => $response->id]) }}">
        @if ($response->isPublished())
            <i class="fas fa-eye text-success" role="button"></i>
        @else
            <i class="fas fa-eye-slash text-danger" role="button"></i>
        @endif
    </span>
@endif
