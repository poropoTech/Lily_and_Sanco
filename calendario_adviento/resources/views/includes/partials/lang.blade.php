<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLanguageLink">
    @foreach(collect(config('boilerplate.locale.languages'))->sortBy('name') as $code => $details)
        @if($code !== app()->getLocale())
            <x-utils.link class="dropdown-item mt-2" icon="fi fi-{{($code ==='en') ? 'gb' : $code}}" :href="route('locale.change', $code)" :text="__(getLocaleName($code))" />
        @endif
    @endforeach
</div><!--dropdown-menu-->

