<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js" dir="{{ $dir ?? 'ltr' }}">
<head>
    @include($partials . 'style')
    @yield('css')
</head>
    <body class="{{ $body_class ?? '' }}">
        
        <!-- content block -->
        @yield('content')

        @include($partials . 'scripts')
        @yield('script')
    </body>
</html>

