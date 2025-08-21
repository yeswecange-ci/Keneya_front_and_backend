<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Keneya'))</title>

    <!-- Meta Description -->
    <meta name="description" content="@yield('description', 'Keneya - Votre marque de confiance')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles -->
    @stack('styles')
</head>

<body class="font-sans antialiased">
    <!-- Header/Navigation -->
    <header class="bg-white shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a href="{{ route('front.home') }}" class="flex-shrink-0">
                        <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}">
                    </a>

                    <!-- Navigation Links -->
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        {{-- <a href="{{ route('front.home') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Accueil
                        </a>
                        <a href="{{ route('front.brand') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Notre Marque
                        </a>
                        <a href="{{ route('front.products') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Produits
                        </a>
                        <a href="{{ route('front.recipes') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Recettes
                        </a>
                        <a href="{{ route('front.blog') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Blog
                        </a>
                        <a href="{{ route('front.findus') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Où nous trouver
                        </a>
                        <a href="{{ route('front.contact') }}"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Contact --}}
                        </a>
                    </div>
                </div>

                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-700">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded-md text-sm hover:bg-blue-700">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">{{ config('app.name') }}</h3>
                    <p class="text-gray-300">
                        Votre marque de confiance pour des produits de qualité.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Navigation</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('front.brand') }}" class="text-gray-300 hover:text-white">Notre
                                Marque</a></li>
                        <li><a href="{{ route('front.products') }}" class="text-gray-300 hover:text-white">Produits</a>
                        </li>
                        <li><a href="{{ route('front.recipes') }}" class="text-gray-300 hover:text-white">Recettes</a>
                        </li>
                        <li><a href="{{ route('front.blog') }}" class="text-gray-300 hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>Email: contact@keneya.com</li>
                        <li>Téléphone: +225 XX XX XX XX</li>
                        <li><a href="{{ route('front.contact') }}" class="hover:text-white">Nous contacter</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Suivez-nous</h3>
                    <div class="flex space-x-4">
                        <!-- Social media links -->
                        <a href="#" class="text-gray-300 hover:text-white">Facebook</a>
                        <a href="#" class="text-gray-300 hover:text-white">Instagram</a>
                        <a href="#" class="text-gray-300 hover:text-white">Twitter</a>
                    </div>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center">
                <p class="text-gray-300">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
