<div class="d-flex justify-content-center">
    <div class="response-card-image-container-icon">
        <a href="{{$response->getMediaURL('pdf')}}" target="_blank"><i class="fa fa-4x fa-file-pdf"></i></a>
    </div>
    <a href="{{$response->getMediaURL('pdf')}} " target="_blank">
        <img class="response-card-image-container-avatar" src="{{$response->user->avatar }}"/>
    </a>
</div>
