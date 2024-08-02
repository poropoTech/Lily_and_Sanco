@extends('frontend.layouts.app')

@section('title', __('Muro'))

@section('content')

    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-8 order-2 order-md-1 d-md-flex w-auto px-0 px-md-4">
                @foreach($responses as $response)
                    <div class="p-2">
                        <x-frontend.response.response-card :response="$response"/>
                    </div>
                    @if ($loop->iteration == 2)
                        @break
                    @endif
                @endforeach
            </div><!--col-md-6-->
            <div class="col-md-4 order-1 order-md-2 pt-2">
                <x-frontend.progress.progress-card :progress="$progress"/>
            </div><!--col-md-6-->
        </div><!--row-->
        <div class="row justify-content-center">
            <div class="col-md-12 order-2 order-md-1">
                <div id="response-wall-feed" data-responses-feed-url="{{ route('frontend.responses.wall_response_feed') }}" class="d-flex flex-wrap justify-content-center">
                    @foreach($responses as $response)
                        @if ($loop->iteration <= 2)
                            @continue
                        @endif
                        <div class="p-2">
                            <x-frontend.response.response-card :response="$response"/>
                        </div>
                    @endforeach
                </div>
            </div><!--col-md-12-->
        </div><!--row-->
        <div class="row">
            <div class="col text-center">
                <x-utils.infinite-scroll-status id="wall"/>
            </div>
        </div>
    </div><!--container-->
@endsection
