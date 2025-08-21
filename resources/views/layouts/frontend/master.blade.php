<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.frontend.head')
</head>

<body>
    @include('partials.frontend.navbar')

    @yield('content')
    @yield('scripts')
    @yield('styles')
</body>

@include('partials.frontend.footer')
@include('partials.frontend.scripts')
</body>

</html>
