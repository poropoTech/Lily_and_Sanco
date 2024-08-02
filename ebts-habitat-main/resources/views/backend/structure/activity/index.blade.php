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
            <livewire:backend.activities-table />
        </x-slot>
    </x-backend.card>
@endsection
