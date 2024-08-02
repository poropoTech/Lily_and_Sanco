@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="main-section main-presentation-section">
                    @include('frontend.pages.main.presentation')
                </div>

                <div id="desafios">
                    <div class="main-section main-categories-section full-width">
                        <div class="container py-4">
                            <h1 class="main-section-title">DESAFIOS</h1>
                            @include('frontend.pages.main.dimensions')
                        </div>
                    </div>
                </div>

                <div id="conecta">
                    <div class="main-section main-wall-section">
                        <h1 class="main-section-title">CONECTA</h1>
                        @include('frontend.pages.main.wall')
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div>
                                    <a href="{{route('frontend.pages.wall')}}" role="button" class="big-link">Al muro <i class="cil-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="progreso">
                    <div class="main-section main-progress-section full-width">
                        <div class="container py-4">
                            <h1 class="main-section-title">PROGRESO</h1>
                            @include('frontend.pages.main.progress')
                        </div>
                    </div>
                </div>

            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
