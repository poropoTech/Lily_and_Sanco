@inject('model', '\App\Domains\Auth\Models\User')
@inject('departmentModel', '\App\Domains\Auth\Models\Department')

@extends('backend.layouts.app')

@section('title', __('Update User'))

@section('content')
    <x-forms.patch :action="route('admin.auth.user.update', $user)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update User')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div x-data="{userType : '{{ $user->type }}'}">


                    @if ($user->isUser())
                        <div class="form-group row">
                            <label for="department_id" class="col-md-2 col-form-label">@lang('Departamento')</label>

                            <div class="col-md-10">
                                <select name="department_id" id="department_id" class="form-control" required>
                                    @foreach($departmentModel::all() as $department)
                                        @if(old('department_id'))
                                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                                        @else
                                            <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div><!--form-group-->
                    @endif

                    <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">@lang('Name')</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $user->name }}" maxlength="100" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="alias" class="col-md-2 col-form-label">@lang('Alias')</label>

                        <div class="col-md-10">
                            <input type="text" name="alias" class="form-control" placeholder="{{ __('Alias') }}" value="{{ old('alias') ?? $user->alias }}" maxlength="15" required />
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label for="email" class="col-md-2 col-form-label">@lang('E-mail Address')</label>

                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') ?? $user->email }}" maxlength="255" required />
                        </div>
                    </div><!--form-group-->

                    @if (!$user->isMasterAdmin())
                        @include('backend.auth.includes.roles')

                        @if (!config('boilerplate.access.user.only_roles'))
                            @include('backend.auth.includes.permissions')
                        @endif
                    @endif
                </div>
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update User')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
