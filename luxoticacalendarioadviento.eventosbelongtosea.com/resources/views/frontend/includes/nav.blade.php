<nav id="frontend-navbar" class="navbar navbar-expand-md navbar-light bg-white">
    <div class="container">


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="@lang('Toggle navigation')">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class= "navbar-nav-logo">
                <img src="{{ asset('img/logos/logo.png') }}" class="img-fluid"  alt="Logo">
            </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.index').'/'"
                        class="nav-link {{ activeClass(Route::is('frontend.index'), 'nav-link-active') }}"
                        :text="__('frontend_header.main_menu.item1')"
                        icon=""
                        />
                </li>
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.pages.categories').'/'"
                        class="nav-link {{ activeClass(Route::is('frontend.pages.categories') || Route::is('frontend.pages.category') || Route::is('frontend.pages.activity'), 'nav-link-active') }}"
                        :text="__('frontend_header.main_menu.item2')"
                        icon=""
                         />
                </li>
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.pages.wall').'/'"
                        class="nav-link {{ activeClass(Route::is('frontend.pages.wall'), 'nav-link-active') }}"
                        :text="__('frontend_header.main_menu.item3')"
                        icon=""
                        />
                </li>
                <li class="nav-item">
                    <x-utils.link
                        data-anchor="progreso"
                        :href="route('frontend.index').'/#progreso'"
                        class="nav-link"
                        :text="__('frontend_header.main_menu.item4')"
                        icon=""
                        />
                </li>
                <li class="nav-item">
                    <x-utils.link
                        :href="route('frontend.pages.prizes').'/'"
                        class="nav-link {{ activeClass(Route::is('frontend.pages.prizes'), 'nav-link-active') }}"
                        :text="__('frontend_header.main_menu.item5')"
                        icon=""
                    />
                </li>

                <li class="nav-item dropdown">
                    <x-utils.link
                        href="#"
                        id="navbarDropdown"
                        class="nav-link dropdown-toggle"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                        v-pre
                    >
                        <x-slot name="text">
                            <img class="rounded-circle" style="max-height: 20px" src="{{ $logged_in_user->avatar }}" />
                            {{ $logged_in_user->name }} <span class="caret"></span>
                        </x-slot>
                    </x-utils.link>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if ($logged_in_user->isAdmin())
                            <x-utils.link
                                :href="route('admin.dashboard')"
                                :text="__('frontend_header.user_menu.item1')"
                                class="dropdown-item" />
                        @endif

                        @if ($logged_in_user->isUser())
                            <x-utils.link
                                :href="route('frontend.user.challenges')"
                                :active="activeClass(Route::is('frontend.user.challenges'))"
                                :text="__('frontend_header.user_menu.item2')"
                                class="dropdown-item"/>
                        @endif

                        <x-utils.link
                            :href="route('frontend.user.account')"
                            :active="activeClass(Route::is('frontend.user.account'))"
                            :text="__('frontend_header.user_menu.item3')"
                            class="dropdown-item" />


                        <x-utils.link
                            :text="__('frontend_header.user_menu.item4')"
                            class="dropdown-item"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <x-slot name="text">
                                @lang('frontend_header.user_menu.item4')
                                <x-forms.post :action="route('frontend.auth.logout')" id="logout-form" class="d-none" />
                            </x-slot>
                        </x-utils.link>
                    </div>
                </li>
                @if(config('boilerplate.locale.status') && count(config('boilerplate.locale.languages')) > 1)
                    <li class="c-header-nav-item dropdown">
                        <x-utils.link
                            class="c-header-nav-link fi fi-{{(app()->getLocale() ==='en') ? 'gb' : app()->getLocale()}}"
                            id="navbarDropdownLanguageLink"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false" />

                        @include('includes.partials.lang')
                    </li>
                @endif
            </ul>
        </div><!--navbar-collapse-->
    </div><!--container-->
</nav>
