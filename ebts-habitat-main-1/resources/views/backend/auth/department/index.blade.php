@extends('backend.layouts.app')

@section('title', __('Gestión de Departamentos'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Gestión de Departamentos')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.department.create')"
                :text="__('Crear Departamento')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.departments-table />
        </x-slot>
    </x-backend.card>
@endsection
