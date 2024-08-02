<div class="row">
    <div class="col-md-12">
        <div id="carouselControl" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner">
                @foreach($carouselResponses as $response)
                    @if ($loop->first)
                        <div class="carousel-item active">
                            <div class="d-md-inline-flex">
                                @elseif($loop->index % 3 == 0)
                                    <div class="carousel-item">
                                        <div class="d-md-inline-flex">
                                            @endif
                                            <div class="px-1">
                                                <x-frontend.response.response-card
                                                    :response="$response"/>
                                            </div>
                                            @if ($loop->last || $loop->iteration % 3 == 0)
                                        </div>
                                    </div>
                                @endif
                                @endforeach
                            </div>
                            <a class="carousel-control-prev" href="#carouselControl"
                               role="button"
                               data-slide="prev">
                                            <span class="carousel-control-prev-icon"
                                                  aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselControl"
                               role="button"
                               data-slide="next">
                                            <span class="carousel-control-next-icon"
                                                  aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
            </div>
        </div>
    </div>
</div>

