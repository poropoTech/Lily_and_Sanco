@if(!$response->imageURL)
    <div class="d-flex justify-content-center">
        <img class="response-card-image-container-avatar" src="{{$response->user->avatar }}"/>
    </div>
@else
    <img class="response-card-image-container-img" src="{{$response->imageURL }}"/>
@endif
