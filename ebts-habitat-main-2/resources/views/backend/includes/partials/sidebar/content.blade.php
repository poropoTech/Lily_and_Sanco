<li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.structure.category.*') || Route::is('admin.structure.activity.*'), 'c-open c-show') }}">
    <x-utils.link
        href="#"
        icon="c-sidebar-nav-icon cil-storage"
        class="c-sidebar-nav-dropdown-toggle"
        :text="__('Contenido')" />

    <ul class="c-sidebar-nav-dropdown-items">
        @if (
                $logged_in_user->hasAllAccess() ||
                (
                    $logged_in_user->can('admin.access.structure.category')
                )
            )
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('admin.structure.category.index')"
                    class="c-sidebar-nav-link"
                    :text="__('Gestión de Categorías')"
                    icon="c-sidebar-nav-icon cil-options"
                    :active="activeClass(Route::is('admin.structure.category.*'), 'c-active')" />
            </li>
        @endif

        @if (
                $logged_in_user->hasAllAccess() ||
                (
                    $logged_in_user->can('admin.access.structure.activity')
                )
            )
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('admin.structure.activity.index')"
                    class="c-sidebar-nav-link"
                    :text="__('Gestión de Actividades')"
                    icon="c-sidebar-nav-icon cil-spreadsheet"
                    :active="activeClass(Route::is('admin.structure.activity.*'), 'c-active')" />
            </li>
        @endif
    </ul>
</li>
