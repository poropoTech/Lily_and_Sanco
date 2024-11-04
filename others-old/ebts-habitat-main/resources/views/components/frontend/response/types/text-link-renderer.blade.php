<div class="d-flex justify-content-center">
    <div class="response-card-image-container-icon">
        <a href="{{$response->ext_content}}" target="_blank"><i class="fa fa-4x fa-link"></i></a>
    </div>
    <a href="{{$response->ext_content}}" target="_blank">
        <img class="response-card-image-container-avatar" src="{{$response->user->avatar }}"/>
    </a>
</div>
