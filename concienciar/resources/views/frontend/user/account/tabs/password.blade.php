<x-forms.patch :action="route('frontend.auth.password.change')">
    <h2>@lang('Seguridad')</h2>
    <div class="form-group row">
        <label for="current_password" class="col-md-6 col-form-label-sm text-md-right">@lang('Contraseña actual')</label>

        <div class="col-md-6">
            <input type="password" name="current_password" class="form-control form-control-sm" placeholder="{{ __('Contraseña actual') }}" maxlength="100" required autofocus />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="password" class="col-md-6 col-form-label-sm text-md-right">@lang('New Password')</label>

        <div class="col-md-6">
            <input type="password" name="password" class="form-control form-control-sm" placeholder="{{ __('New Password') }}" maxlength="100" required />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="password_confirmation" class="col-md-6 col-form-label-sm text-md-right">@lang('Confirmación de contraseña')</label>

        <div class="col-md-6">
            <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="{{ __('Confirmación de contraseña') }}" maxlength="100" required />
        </div>
    </div><!--form-group-->

    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Password')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
