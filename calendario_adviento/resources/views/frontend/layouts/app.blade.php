<!doctype html>
<html lang="{{ htmlLang() }}" @langrtl dir="rtl" @endlangrtl>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ appName() }} | @yield('title')</title>
    <meta name="description" content="@yield('meta_description', appName())">
    <meta name="author" content="@yield('meta_author', 'HazteWeb')">
    @yield('meta')

    @stack('before-styles')
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ mix('css/frontend.css') }}" rel="stylesheet">
    <livewire:styles />
    @stack('after-styles')
    <style>{!! getSysSetting('system.design.frontend') !!}</style>
</head>
<body>
    @include('includes.partials.read-only')
    @include('includes.partials.logged-in-as')
    @include('includes.partials.announcements')

    <div id="app">
        @include('frontend.includes.nav')
        @include('includes.partials.messages')

        <main>
            @yield('content')
        </main>
        <div id="btnTop" class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;display: none; position: fixed; z-index:999">
            <a href="#app" class="btn-floating btn-primary btn-circle btn-md">
                <i class="fa fa-arrow-up"></i>
            </a>
        </div>
        @include('frontend.includes.footer')
    </div><!--app-->

    @stack('before-scripts')
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/frontend.js') }}"></script>
    <livewire:scripts />
    @stack('after-scripts')
</body>
</html>
