<x-forms.patch :action="route('frontend.auth.password.change')">
    <h2>@lang('frontend_users.account.security')</h2>
    <div class="form-group row">
        <label for="current_password" class="col-md-6 col-form-label-sm text-md-right">@lang('frontend_users.account.current_password')</label>

        <div class="col-md-6">
            <input type="password" name="current_password" class="form-control form-control-sm" placeholder="{{ __('frontend_users.account.current_password') }}" maxlength="100" required autofocus />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="password" class="col-md-6 col-form-label-sm text-md-right">@lang('frontend_users.account.new_password')</label>

        <div class="col-md-6">
            <input type="password" name="password" class="form-control form-control-sm" placeholder="{{ __('frontend_users.account.new_password') }}" maxlength="100" required />
        </div>
    </div><!--form-group-->

    <div class="form-group row">
        <label for="password_confirmation" class="col-md-6 col-form-label-sm text-md-right">@lang('general.confirm_password')</label>

        <div class="col-md-6">
            <input type="password" name="password_confirmation" class="form-control form-control-sm" placeholder="{{ __('general.confirm_password') }}" maxlength="100" required />
        </div>
    </div><!--form-group-->

    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('frontend_users.account.update_password')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
