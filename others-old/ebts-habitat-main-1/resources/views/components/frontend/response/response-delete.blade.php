@if($logged_in_user->can('admin.access.user-content.delete-responses') || $logged_in_user->id == $response->user->id)
    <span class="response-delete response-card-actions response-card-actions-delete" x-data-response-delete-url="{{route('frontend.responses.delete', ['response' => $response->id]) }}">
        <i class="fas fa-trash text-dark" role="button"></i>
    </span>
@endif
