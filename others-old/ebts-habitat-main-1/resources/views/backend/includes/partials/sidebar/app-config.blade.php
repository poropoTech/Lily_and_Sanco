<li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.config.app.*'), 'c-open c-show') }}">
    <x-utils.link
        href="#"
        icon="c-sidebar-nav-icon cil-settings"
        class="c-sidebar-nav-dropdown-toggle"
        :text="__('Configuración')" />

    <ul class="c-sidebar-nav-dropdown-items">
        @if (
                $logged_in_user->hasAllAccess() ||
                (
                    $logged_in_user->can('admin.access.app-config.notifications')
                )
            )
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('admin.config.app.notifications.index')"
                    class="c-sidebar-nav-link"
                    :text="__('Gestión de Notificaciones')"
                    :active="activeClass(Route::is('admin.config.app.*'), 'c-active')" />
            </li>
        @endif
    </ul>
</li>
