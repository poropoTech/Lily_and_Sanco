@if ($logged_in_user->hasAllAccess())
    <li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.config.sys.*'), 'c-open c-show') }}">
        <x-utils.link
            href="#"
            icon="c-sidebar-nav-icon cil-settings"
            class="c-sidebar-nav-dropdown-toggle"
            :text="__('Configuración')" />

        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('admin.config.sys.styles.index')"
                    class="c-sidebar-nav-link"
                    :text="__('Gestión de estilos')"
                    :active="activeClass(Route::is('admin.config.sys.*'), 'c-active')" />
            </li>
        </ul>
    </li>
@endif
