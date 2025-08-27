<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.frontend.head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    @include('partials.frontend.navbar')

    @yield('content')
    @yield('scripts')
    @yield('styles')
</body>

@include('partials.frontend.footer')
@include('partials.frontend.scripts')
@include('components.cookies-banner')
</body>

</html>
