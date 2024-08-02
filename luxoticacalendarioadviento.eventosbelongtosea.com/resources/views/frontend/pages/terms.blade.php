@extends('frontend.layouts.app')

@section('title', __('frontend_pages_terms.page_title'))

@section('content')
    <div class="container pt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('frontend_pages_terms.title')
                    </x-slot>

                    <x-slot name="body">
                        @lang('frontend_pages_terms.text')
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
