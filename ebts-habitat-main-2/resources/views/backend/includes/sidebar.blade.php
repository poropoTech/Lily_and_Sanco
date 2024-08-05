<div class="c-sidebar c-sidebar-light c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand d-lg-down-none">
        <img src="{{ asset('img/logos/belong-to-sea.svg#full') }}" class="c-sidebar-brand-full" width="118" height="46" alt="Logo">
        <img src="{{ asset('img/logos/belong-to-sea.svg#full') }}" class="c-sidebar-brand-minimized" width="46" height="46" alt="Logo">
    </div><!--c-sidebar-brand-->

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <x-utils.link
                class="c-sidebar-nav-link"
                :href="route('admin.dashboard')"
                :active="activeClass(Route::is('admin.dashboard'), 'c-active')"
                icon="c-sidebar-nav-icon cil-speedometer"
                :text="__('Dashboard')" />
        </li>

        <li class="c-sidebar-nav-title">@lang('Gestión')</li>
        @if (
               $logged_in_user->hasAllAccess() ||
               (
                   $logged_in_user->can('admin.access.structure.category') ||
                   $logged_in_user->can('admin.access.structure.activity')
               )
           )
            @include('backend.includes.partials.sidebar.content')
        @endif

        @if (
               $logged_in_user->hasAllAccess() ||
               (
                   $logged_in_user->can('admin.access.user.list') ||
                   $logged_in_user->can('admin.access.user.deactivate') ||
                   $logged_in_user->can('admin.access.user.reactivate') ||
                   $logged_in_user->can('admin.access.user.clear-session') ||
                   $logged_in_user->can('admin.access.user.impersonate') ||
                   $logged_in_user->can('admin.access.user.change-password') ||
                   $logged_in_user->can('admin.access.user.departments')
               )
           )
            @include('backend.includes.partials.sidebar.users')
        @endif
        @if (
               $logged_in_user->hasAllAccess() ||
               (
                   $logged_in_user->can('admin.access.app-config.notifications')
               )
           )
            @include('backend.includes.partials.sidebar.app-config')
        @endif

        @if ($logged_in_user->hasAllAccess())
            <li class="c-sidebar-nav-title">@lang('System')</li>
            @include('backend.includes.partials.sidebar.roles')
            @include('backend.includes.partials.sidebar.sys-config')
            @include('backend.includes.partials.sidebar.logs')
        @endif

    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent" data-class="c-sidebar-minimized"></button>
</div><!--sidebar-->
