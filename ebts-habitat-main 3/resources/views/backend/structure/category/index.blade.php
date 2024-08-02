@extends('backend.layouts.app')

@section('title', __('Gestión de Categorías'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Gestión de Categorías')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.structure.category.create')"
                :text="__('Crear Categoría')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.categories-table />
        </x-slot>
    </x-backend.card>
@endsection
