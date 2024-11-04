@extends('frontend.layouts.app')

@section('title', __('Catogoría y desafíos'))

@section('content')
    @include('frontend.includes.partials.breadcrumbs')

    <div class="page-header-img-container">
        <img class="img-fluid" src="{{$category->imageURL}}">
    </div>
    <div class="container pt-4 category-page-container">
        <div class="row">
            <div class="col-md-6">
                <div class="text-md-center">
                    <a class="category-card-link" href="{{ route('frontend.pages.category', ['category' => $category->id]) }}">
                        <img class="activity-title-category-icon" src="{{$category->iconURL }}"/>
                    </a>
                </div>
                <div class="activity-title-container justify-content-md-center">
                    <div class="activity-title-text">
                        <span class="activity-title-title">{{ strtoupper($category->name) }}<br><span class="activity-title-name">@lang('DESAFÍOS')</span> </span>
                    </div>
                </div>
            </div><!--col-md-6-->
            <div class="col-md-6">
                <div class="category-content">{!! $category->content !!}</div>
                @if($logged_in_user->can('admin.access.structure.category'))
                    <x-frontend.category.category-admin-bar :category="$category"/>
                @endif
            </div><!--col-md-6-->
        </div><!--row-->
        <div class="full-width" style="background-color: #f8f8f8">
            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div id="category-activity-wall-feed" data-activities-feed-url="{{ route('frontend.activities.category_wall_feed', ['category' => $category->id]) }}" class="d-flex flex-wrap justify-content-center">
                        @foreach($activities as $activity)
                            <x-frontend.activity.activity-card :activity="$activity" separator/>
                        @endforeach
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <x-utils.infinite-scroll-status id="category"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--container-->
@endsection
