@extends('frontend.layouts.app')

@section('title', __('My Account'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                @include('frontend.user.account.tabs.information')
            </div>
            <div class="col-md-5">
                @include('frontend.user.account.tabs.password')
            </div>
        </div><!--row-->
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-7">--}}
{{--                @include('frontend.user.account.tabs.notifications')--}}
{{--            </div>--}}
{{--            <div class="col-md-5">--}}

{{--            </div>--}}
{{--        </div><!--row-->--}}
    </div><!--container-->
@endsection
