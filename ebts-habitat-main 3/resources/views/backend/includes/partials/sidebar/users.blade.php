@if (
            $logged_in_user->hasAllAccess() ||
            (
                $logged_in_user->can('admin.access.user.list') ||
                $logged_in_user->can('admin.access.user.deactivate') ||
                $logged_in_user->can('admin.access.user.reactivate') ||
                $logged_in_user->can('admin.access.user.clear-session') ||
                $logged_in_user->can('admin.access.user.impersonate') ||
                $logged_in_user->can('admin.access.user.change-password')
            )
        )

    <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.user.*'), 'c-open c-show') }}">
        <x-utils.link
            href="#"
            icon="c-sidebar-nav-icon cil-user"
            class="c-sidebar-nav-dropdown-toggle"
            :text="__('Access')" />

        <ul class="c-sidebar-nav-dropdown-items">
            @if (
                $logged_in_user->hasAllAccess() ||
                (
                    $logged_in_user->can('admin.access.user.list') ||
                    $logged_in_user->can('admin.access.user.deactivate') ||
                    $logged_in_user->can('admin.access.user.reactivate') ||
                    $logged_in_user->can('admin.access.user.clear-session') ||
                    $logged_in_user->can('admin.access.user.impersonate') ||
                    $logged_in_user->can('admin.access.user.change-password')
                )
            )
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.auth.user.index')"
                        class="c-sidebar-nav-link"
                        :text="__('User Management')"
                        :active="activeClass(Route::is('admin.auth.user.*'), 'c-active')" />
                </li>
            @endif

                @if (
                    $logged_in_user->hasAllAccess() ||
                    (
                        $logged_in_user->can('admin.access.user.departments')
                    )
                )
                    <li class="c-sidebar-nav-item">
                        <x-utils.link
                            :href="route('admin.auth.department.index')"
                            class="c-sidebar-nav-link"
                            :text="__('Gestión de Departamentos')"
                            :active="activeClass(Route::is('admin.auth.department.*'), 'c-active')" />
                    </li>
                @endif

        </ul>
    </li>
@endif
