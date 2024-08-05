@extends('frontend.layouts.app')

@section('title', __('frontend_pages_knowmore.page_title'))

@section('content')

    <div class="page-header-img-container">
        <img class="img-fluid" src="{{asset('/img/pages/knowmore/header.png') }}">
    </div>
{{--    <div class="page-header-video-container">--}}
{{--        <video autoplay muted loop src="{{ asset('video/header.mp4') }}" ></video>--}}
{{--    </div>--}}
    <div class="container pt-4 knowmore-page-container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="knowmore-title-container">
                            @lang('frontend_pages_knowmore.title')
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="knowmore-img-container">
                            <img class="img-fluid knowmore-img" src="{{asset('/img/pages/knowmore/rounded.png') }}">
                        </div>
                    </div>
                </div>
            </div><!--col-md-6-->
            <div class="col-md-6 knowmore-text">
                @lang('frontend_pages_knowmore.text')
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div>
                            <a href="{{url()->previous()}}" role="button" class="big-link"><i class="cil-arrow-left"></i>@lang('frontend_pages_knowmore.back_button')</a>
                        </div>
                    </div>
                </div>
            </div><!--col-md-6-->
        </div><!--row-->
    </div><!--container-->
@endsection
