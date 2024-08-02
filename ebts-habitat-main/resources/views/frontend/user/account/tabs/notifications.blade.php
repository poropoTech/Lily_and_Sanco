@inject('model', '\App\Domains\Auth\Models\Department')

<x-forms.patch :action="route('frontend.user.profile.update')">

    <h2>@lang('Notificaciones')</h2>

    <div class="form-group row ">
        <label for="name" class="col-md-3 col-form-label-sm text-md-right">@lang('Nuevos desafios')</label>

        <div class="col-md-9">
            <input type="checkbox" checked data-toggle="toggle" data-size="sm">
{{--            <input type="text" name="name" class="form-control form-control-sm" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $logged_in_user->name }}" required autofocus autocomplete="name" />--}}
        </div>
    </div><!--form-group-->

    <div class="form-group row ">
        <label for="name" class="col-md-3 col-form-label-sm text-md-right">@lang('Nuevos desafios')</label>

        <div class="col-md-9">
            <input type="checkbox" checked data-toggle="toggle" data-size="sm">
            {{--            <input type="text" name="name" class="form-control form-control-sm" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $logged_in_user->name }}" required autofocus autocomplete="name" />--}}
        </div>
    </div><!--form-group-->

    <div class="form-group row ">
        <label for="name" class="col-md-3 col-form-label-sm text-md-right">@lang('Nuevos desafios')</label>

        <div class="col-md-9">
            <input type="checkbox" checked data-toggle="toggle" data-size="sm">
            {{--            <input type="text" name="name" class="form-control form-control-sm" placeholder="{{ __('Name') }}" value="{{ old('name') ?? $logged_in_user->name }}" required autofocus autocomplete="name" />--}}
        </div>
    </div><!--form-group-->

    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Actualizar notificaciones')</button>
        </div>
    </div><!--form-group-->
</x-forms.patch>
