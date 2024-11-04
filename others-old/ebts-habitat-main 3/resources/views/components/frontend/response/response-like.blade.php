<span class="response-like response-card-actions response-card-actions-like" x-data="{{route('frontend.responses.like', ['response' => $response->id]) }}">
@if ($response->isLiked())
    <i class="fas fa-heart text-danger" role="button"></i>
@else
    <i class="fas fa-heart" role="button"></i>
@endif
</span>
