@extends('backend.layouts.app')

@section('title', __('Gestión de Actividades'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Gestión de Actividades')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.structure.activity.create')"
                :text="__('Crear Actividad')"
            />
        </x-slot>

        <x-slot name="body">
            <div class="card">
                <div class="card-header">
                    @lang('Idiomas')
                </div>
                <div class="row py-4 px-4">
                    <div class="form-group col-md-4">
                        <span>Idioma principal:</span> <span class="fi fi-{{config('boilerplate.locale.language')}}"></span>
                    </div><!--form-group-->
                </div>
                <div class="row px-4">
                    <div class="form-group col-md-4">
                        <span>Idioma actual:</span>
                        @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
                            <x-utils.link
                                class="c-header-nav-link fi fi-{{(app()->getLocale() ==='en') ? 'gb' : app()->getLocale()}}"
                                id="navbarDropdownLanguageLink"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false" />
                            <div class="c-header-nav-item dropdown">
                                @include('includes.partials.lang')
                            </div>
                        @endif
                    </div><!--form-group-->
                </div>
            </div>
            <livewire:backend.activities-table />
        </x-slot>
    </x-backend.card>
@endsection
