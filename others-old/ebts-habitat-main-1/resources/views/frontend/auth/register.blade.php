@inject('model', '\App\Domains\Auth\Models\Department')

@extends('frontend.layouts.auth')

@section('title', __('Register'))

@push('after-styles')
    <style>
        .cropper-view-box,
        .cropper-face {
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-3 text-md-right">
                    <div class="register-img-text">
                        <p class="register-title text-left">POR UN BIENESTAR GLOBAL.<br><span style="color:#000;">CONCIENCIAR</span> </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="register-img-container">
                        <img class="img-fluid" src="/img/login.png">
                    </div>
                </div>
                <div class="col-md-3 text-left">
                    <x-forms.post :action="route('frontend.auth.register')" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{ old('name') }}"
                                       placeholder="{{ __('Name') }}" maxlength="100" required autofocus
                                       autocomplete="name"/>
                            </div>
                        </div><!--form-group-->

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-12">--}}
{{--                                <input type="text" name="alias" id="alias" class="form-control form-control-sm" value="{{ old('alias') }}"--}}
{{--                                       placeholder="{{ __('Alias') }}" maxlength="100" required autofocus--}}
{{--                                       autocomplete="nickname"/>--}}
{{--                            </div>--}}
{{--                        </div><!--form-group-->--}}

                        <div class="form-group row">
                            <div class="col-md-12">
                                <select name="department_id" id="department_id"class="form-control form-control-sm" required>
                                    <option disabled selected>Selecciona un departamento</option>
                                    @foreach($model::all() as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="email" name="email" id="email" class="form-control form-control-sm"
                                       placeholder="{{ __('E-mail Address') }}" value="{{ old('email') }}" maxlength="255"
                                       required autocomplete="email"/>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="password" name="password" id="password" class="form-control form-control-sm"
                                       placeholder="{{ __('Password') }}" maxlength="100" required
                                       autocomplete="new-password"/>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="form-control form-control-sm" placeholder="{{ __('Password Confirmation') }}" maxlength="100"
                                       required autocomplete="new-password"/>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <x-forms.avatar-selector classBtn="btn btn-sm btn-primary mr-3"
                                                         classPreview="rounded-circle img-thumbnail"
                                                         id="1" name="avatar" width="50"
                                                         height="50">
                                </x-forms.avatar-selector>
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <div class="col-md-12 mt-4">
                                <div class="form-check">
                                    <input type="checkbox" name="terms" value="1" id="terms" class="form-check-input"
                                           required>
                                    <label class="form-check-label small" for="terms">
                                        @lang('Acepto la ') <a href="{{ route('frontend.pages.terms') }}"
                                                                   target="_blank">@lang('política de privacidad')</a>
                                    </label>
                                </div>
                            </div>
                        </div><!--form-group-->

                        @if(config('boilerplate.access.captcha.registration'))
                            <div class="row">
                                <div class="col">
                                    @captcha
                                    <input type="hidden" name="captcha_status" value="true"/>
                                </div><!--col-->
                            </div><!--row-->
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-sm" type="submit">@lang('Register')</button>
                            </div>
                        </div><!--form-group-->
                    </x-forms.post>
                </div><!--col-md-8-->
            </div><!--row-->
        </div><!--container-->
    </div>
</section>
@endsection
