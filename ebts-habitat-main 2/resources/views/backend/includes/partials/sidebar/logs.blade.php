@if ($logged_in_user->hasAllAccess())
    <li class="c-sidebar-nav-dropdown">
        <x-utils.link
            href="#"
            icon="c-sidebar-nav-icon cil-list"
            class="c-sidebar-nav-dropdown-toggle"
            :text="__('Logs')" />

        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('log-viewer::dashboard')"
                    class="c-sidebar-nav-link"
                    :text="__('Dashboard')" />
            </li>
            <li class="c-sidebar-nav-item">
                <x-utils.link
                    :href="route('log-viewer::logs.list')"
                    class="c-sidebar-nav-link"
                    :text="__('Logs')" />
            </li>
        </ul>
    </li>
@endif
