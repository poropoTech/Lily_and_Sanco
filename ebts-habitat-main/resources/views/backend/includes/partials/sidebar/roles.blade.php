@if ( $logged_in_user->hasAllAccess())
    <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.auth.role.*'), 'c-open c-show') }}">
        <x-utils.link
            href="#"
            icon="c-sidebar-nav-icon cil-user"
            class="c-sidebar-nav-dropdown-toggle"
            :text="__('Access')" />

        <ul class="c-sidebar-nav-dropdown-items">
            @if ($logged_in_user->hasAllAccess())
                <li class="c-sidebar-nav-item">
                    <x-utils.link
                        :href="route('admin.auth.role.index')"
                        class="c-sidebar-nav-link"
                        :text="__('Role Management')"
                        :active="activeClass(Route::is('admin.auth.role.*'), 'c-active')" />
                </li>
            @endif
        </ul>
    </li>
@endif
