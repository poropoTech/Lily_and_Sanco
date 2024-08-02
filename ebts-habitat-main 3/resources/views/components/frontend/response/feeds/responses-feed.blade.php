@foreach($responses as $response)
    <div class="response-feed-item p-2">
        <x-frontend.response.response-card :response="$response"/>
    </div>
@endforeach
@if($itemsPerPage == count($responses))
    <div class="feed-more-items"></div>
@endif
