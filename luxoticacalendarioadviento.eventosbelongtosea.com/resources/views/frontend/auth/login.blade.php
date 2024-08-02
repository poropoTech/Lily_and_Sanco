@extends('frontend.layouts.auth')

@section('title', __('frontend_auth.login.page_title'))

@section('content')

<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="login-img-container">
                        <img class="img-fluid" src="/img/login.png">
                    </div>
                </div>
                <div class="col-md-4 pt-md-5 text-left">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="login-title">
                                @lang('frontend_auth.login.text')
                            </p>
                        </div>
                    </div>
                    <x-forms.post :action="route('frontend.auth.login')">
                        <div class="form-group row">
                            <div class="col-md-8">
                                <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="{{ __('general.email') }}" value="{{ old('email') }}" maxlength="255" required autofocus autocomplete="email" />
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row">
                            <div class="col-md-8">
                                <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="{{ __('general.password') }}" maxlength="100" required autocomplete="current-password" />
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <button class="btn btn-primary btn-sm w-100" type="submit">@lang('frontend_auth.login.enter_button')</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input name="remember" id="remember" class="form-check-input" type="checkbox" {{ old('remember') ? 'checked' : '' }} />

                                    <label class="form-check-label small" for="remember">
                                        @lang('frontend_auth.login.remember_me')
                                    </label>
                                </div><!--form-check-->
                            </div>
                        </div><!--form-group-->

                        <div class="form-group row mb-0">
                            <div class="col-md-8">
                                <x-utils.link :href="route('frontend.auth.register')" class="btn btn-primary btn-sm w-100" :text="__('frontend_auth.login.register_button')" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <x-utils.link :href="route('frontend.auth.password.request')" class="btn btn-sm btn-link" :text="__('frontend_auth.login.forgot_password')" />
                            </div>
                        </div><!--form-group-->
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
                                    <div class="c-header-nav-item dropdown">
                                        <x-utils.link
                                            class="c-header-nav-link fi fi-{{(app()->getLocale() ==='en') ? 'gb' : app()->getLocale()}}"
                                            id="navbarDropdownLanguageLink"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false" />

                                        @include('includes.partials.lang')
                                    </div>
                                @endif
                            </div>
                        </div><!--form-group-->
                    </x-forms.post>
                </div><!--col-md-8-->
            </div><!--row-->
        </div><!--container-->
    </div>
</section>
@endsection
