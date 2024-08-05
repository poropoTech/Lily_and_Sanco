@extends('backend.layouts.app')

@section('title', __('Actualizar Departamento'))

@section('content')
    <x-forms.patch :action="route('admin.auth.department.update', $department)" enctype="multipart/form-data">
        <x-backend.card>
            <x-slot name="header">
                @lang('Actualizar Departamento')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.department.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">

                <div class="form-group row">
                    <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>
                    <div class="col-md-10">
                        <input type="text"  name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $department->name }}" maxlength="100" required />
                    </div>
                </div><!--form-group-->

            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Actualizar Departamento')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
