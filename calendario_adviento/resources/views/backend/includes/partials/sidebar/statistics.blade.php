<li class="c-sidebar-nav-dropdown {{ activeClass(Route::is('admin.statistics.*'), 'c-open c-show') }}">
    <x-utils.link
        href="#"
        icon="c-sidebar-nav-icon cil-chart-line"
        class="c-sidebar-nav-dropdown-toggle"
        :text="__('Estadísticas')" />

    <ul class="c-sidebar-nav-dropdown-items">
        @if (
                    $logged_in_user->hasAllAccess() ||
                    (
                        $logged_in_user->can('admin.access.statistics.general')
                    )
                )
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('admin.statistics.general.index')"
                    class="c-sidebar-nav-link"
                    :text="__('General')"
                    :active="activeClass(Route::is('admin.statistics.general'), 'c-active')" />
            </li>
        @endif
    </ul>
</li>
