<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.backend.head')
</head>

<body>



    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('partials.backend.navbar')
            <div class="main-sidebar sidebar-style-2">
                @include('partials.backend.sidebar')
            </div>
            <div class="main-content">
                @yield('content')
                @yield('scripts')
                @yield('styles')
            </div>
        </div>
    </div>
</body>

@include('partials.backend.footer')
@include('partials.backend.script')
</body>

</html>
