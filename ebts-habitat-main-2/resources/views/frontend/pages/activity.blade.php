@extends('frontend.layouts.app')

@section('title', __('Desafío'))

@section('content')
    @include('frontend.includes.partials.breadcrumbs')
    <div class="page-header-img-container">
        <div>
            <img class="img-fluid" src="{{$activity->imageHeaderURL}}">
            <div class="activity-name">
                <div class="activity-name-txt-img d-none">{{ $activity->title }}</div>
            </div>
        </div>
    </div>
    <div class="container activity-page-container">
        <div class="row py-5 justify-content-center">
            <div class="col-md-6 activity-title">
                <div class="text-md-center">
                    <div class="activity-name-txt pb-3"><h2>{{ $activity->title }}</h2></div>
                    <a class="category-card-link d-none d-md-block" href="{{ route('frontend.pages.category', ['category' => $activity->category->id]) }}">
                        <img class="activity-title-category-icon" src="{{$activity->category->iconURL }}"/>
                    </a>
                </div>
                {{--<div class="activity-title-container justify-content-md-center">
                    <div class="activity-title-text">
                        <span class="activity-title-title">{{ strtoupper($activity->category->name) }}<br><span class="activity-title-name">@lang('DESAFÍOS')</span> </span>
                    </div>
                </div>--}}
            </div><!--col-md-6-->
            <div class="col-md-6">

                <div class="activity-content">{!! $activity->intro_content !!}</div>
                @if($logged_in_user->can('admin.access.structure.activity'))
                    <x-frontend.activity.activity-admin-bar :activity="$activity"/>
                @endif
            </div><!--col-md-6-->
        </div><!--row-->
        <div class="full-width activity-individual-section">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-md-10 text-center">
                        <div class="row pt-3">
                            <div class="col">
                                <i class="fas fa-3x fa-user"></i>
                                <h2>Desafío individual</h2>
                            </div>
                        </div>
                        <div class="row py-4">
                            <div class="col activity-content">
                                {!! $activity->individual_content !!}
                            </div>
                        </div>
                        <div class="row py-3 d-flex justify-content-center">
                            <x-frontend.activity.activity-response-btn :activity="$activity" challenge="individual"/>
                            {{--@if(! $activity->isIndividualChallengeDone($logged_in_user))
                                <x-frontend.activity.activity-response-btn :activity="$activity" challenge="individual"/>
                            @else
                                <i class="far fa-4x fa-check-circle text-primary"></i>
                            @endif
--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-10 text-center">
                <div class="row pt-5">
                    <div class="col">
                        <i class="fas fa-3x fa-users"></i>
                        <h2>Desafío colectivo</h2>
                    </div>
                </div>
                <div class="row py-4">
                    <div class="col activity-content">
                        {!! $activity->collective_content !!}
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col d-flex justify-content-center">
                        @if(is_null($userCollectiveResponse))
                            <x-frontend.activity.activity-response-btn :activity="$activity" challenge="collective"/>
                        @else
                            <x-frontend.response.response-card :response="$userCollectiveResponse"/>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="activity-user-challenges-section">
            <div class="row justify-content-center py-3">
                <h2>@lang('Otros desafíos...')</h2>
                <div class="col-md-12">
                    <div id="activity-response-wall-feed" data-responses-feed-url="{{ route('frontend.responses.activity_wall_feed', ['activity' => $activity->id]) }}" class="d-flex flex-wrap justify-content-center">
                        @foreach($responses as $response)
                            @if(! is_null($userCollectiveResponse) && $response->id == $userCollectiveResponse->id)
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
                    <x-utils.infinite-scroll-status id="activity"/>
                </div>
            </div>
        </div>
    </div><!--container-->
    <div id="response-new-modal-container"></div>
@endsection
