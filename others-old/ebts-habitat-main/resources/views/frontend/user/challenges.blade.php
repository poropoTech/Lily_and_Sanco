@extends('frontend.layouts.app')

@section('title', __('Mis desafíos'))

@section('content')
    <div class="user-challenges-page">
        <div class="user-challenges-page-stats full-width">
            <div class="container py-4">
                <h2 class="py-3">@lang('Progreso personal')</h2>
                <div class="row">
                    <div class="col-md-12 text-center">
                        @foreach($categories as $category)
                            <x-frontend.user.challenges.category-card :category="$category" :stats="$stats[$category->id]"/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="user-challenges-page-todo">
            <div class="user-challenges-page-todo container py-4">
                <h2 class="py-3">@lang('Desafíos incompletos')</h2>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div id="user-incomplete-wall-feed" data-activities-feed-url="{{ route('frontend.activities.user_incomplete_wall_feed') }}" class="d-flex flex-wrap justify-content-center">
                            @foreach($activities as $activity)
                                <x-frontend.activity.activity-card :activity="$activity" separator/>
                            @endforeach
                        </div>
                    </div><!--col-md-10-->
                </div><!--row-->
                <div class="row">
                    <div class="col text-center">
                        <x-utils.infinite-scroll-status id="challenges"/>
                    </div>
                </div>
            </div><!--container-->
        </div>
    </div>
@endsection
