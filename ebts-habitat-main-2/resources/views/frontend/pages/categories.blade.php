@extends('frontend.layouts.app')

@section('title', __('Categorías y desafíos'))

@section('content')
    @include('frontend.includes.partials.breadcrumbs')
    <div class="page-header-img-container">

    </div>

    <div class="container pt-4 category-page-container">
        <div class="row pt-4" >
            <div class="col-md-4 text-left">
                <h2>Categorías de desafíos</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 text-center d-md-flex align-content-start justify-content-center">
                @foreach($categories as $category)
                    <x-frontend.category.category-card :category="$category" :newActivities="$newActivities[$category->id]"/>
                @endforeach
            </div>
        </div>
        <div class="full-width" style="background-color: #f8f8f8">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-4 text-left">
                        <h2>Desafíos</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div id="category-activity-wall-feed" data-activities-feed-url="{{ route('frontend.activities.categories_wall_feed') }}" class="d-flex flex-wrap justify-content-center">
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
