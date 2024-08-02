@inject('model', '\App\Domains\Auth\Models\Department')

<x-forms.patch :action="route('frontend.user.profile.update')">

    <h2>@lang('Perfil')</h2>
    <div class="form-group row ">
        <label for="name" class="col-md-3 col-form-label-sm text-md-right">@lang('Name')</label>

        <div class="col-md-9">
            <input type="text" name="name" class="form-control form-control-sm" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $logged_in_user->name }}" required autofocus autocomplete="name" />
        </div>
    </div><!--form-group-->

{{--    <div class="form-group row ">--}}
{{--        <label for="alias" class="col-md-3 col-form-label-sm text-md-right">@lang('Alias')</label>--}}

{{--        <div class="col-md-9">--}}
{{--            <input type="text" name="alias" class="form-control form-control-sm" placeholder="{{ __('Alias') }}" value="{{ old('alias') ?? $logged_in_user->alias }}" required autofocus autocomplete="nickname" />--}}
{{--        </div>--}}
{{--    </div><!--form-group-->--}}

    <div class="form-group row">
        <label for="department_id" class="col-md-3 col-form-label-sm text-md-right">@lang('Departamento')</label>

        <div class="col-md-9">
            <select name="department_id" id="department_id" class="form-control form-control-sm" required>
                @foreach($model::onlyPublished()->get() as $department)
                    @if(old('department_id'))
                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                    @else
                        <option value="{{ $department->id }}" {{ $logged_in_user->department_id == $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div><!--form-group-->

    <div class="form-group row">

        <div class="offset-md-3 col-md-9">
            <x-forms.avatar-selector classBtn="btn btn-sm btn-primary mr-3"
                                     classPreview="rounded-circle img-thumbnail"
                                     id="1" name="avatar" width="50"
                                     height="50" src="{{ $logged_in_user->avatar }}">
            </x-forms.avatar-selector>
        </div>
    </div><!--form-group-->

    @if ($logged_in_user->canChangeEmail())
        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label-sm text-md-right">@lang('E-mail Address')</label>

            <div class="col-md-9">
                <x-utils.alert type="info" class="mb-3 small" :dismissable="false">
                    <i class="fas fa-info-circle"></i> @lang('If you change your e-mail you will be logged out until you confirm your new e-mail address.')
                </x-utils.alert>

                <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="{{ __('E-mail Address') }}" value="{{ old('email') ?? $logged_in_user->email }}" required autocomplete="email" />
            </div>
        </div><!--form-group-->
    @endif

    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
