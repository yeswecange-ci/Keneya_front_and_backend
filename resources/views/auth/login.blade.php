<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Connexion - {{ config('app.name', 'Keneya') }}</title>

    <!-- Favicon -->
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('img/logo1.png') }}' />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css'])

    <style>
        body, html {
            overflow: hidden;
            height: 100vh;
            margin: 0;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .input-field {
            transition: all 0.3s ease;
        }

        .input-field:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.4);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body class="font-sans antialiased gradient-bg">
    <div class="h-screen flex items-center justify-center px-4">
        <!-- Container principal -->
        <div class="w-full max-w-6xl h-[90vh]">
            <div class="glass-effect shadow-2xl rounded-3xl overflow-hidden h-full">
                <div class="grid grid-cols-1 lg:grid-cols-2 h-full">
                    <!-- Partie gauche - Logo et branding -->
                    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 p-8 lg:p-12 flex flex-col justify-center items-center relative overflow-hidden">
                        <!-- Decoration circles -->
                        <div class="absolute top-0 left-0 w-64 h-64 bg-purple-500 rounded-full opacity-10 -translate-x-1/2 -translate-y-1/2"></div>
                        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full opacity-10 translate-x-1/2 translate-y-1/2"></div>

                        <!-- Contenu -->
                        <div class="text-center relative z-10 floating">
                            <img src="{{ asset('img/logo2.png') }}" alt="Keneya Logo" class="w-32 h-auto mb-4 mx-auto drop-shadow-2xl">
                            <h1 class="text-3xl font-bold mb-3 text-white">KENEYA IMPACT</h1>
                            <div class="w-20 h-1 bg-gradient-to-r from-purple-400 to-blue-400 mx-auto mb-4 rounded-full"></div>
                            <p class="text-xl mb-4 text-gray-200 font-light">Espace Administration</p>
                            <p class="text-sm text-gray-300 max-w-md mx-auto leading-relaxed">
                                Gérez votre contenu, suivez vos statistiques et administrez votre plateforme en toute simplicité.
                            </p>
                        </div>

                        <!-- Statistiques décoratives -->
                        <div class="mt-6 grid grid-cols-3 gap-3 w-full max-w-md relative z-10">
                            <div class="text-center p-3 bg-white/10 backdrop-blur-sm rounded-xl stat-card border border-white/20">
                                <div class="text-2xl font-bold text-white">500+</div>
                                <div class="text-xs text-gray-300 mt-1">Visiteurs</div>
                            </div>
                            <div class="text-center p-3 bg-white/10 backdrop-blur-sm rounded-xl stat-card border border-white/20">
                                <div class="text-2xl font-bold text-white">24/7</div>
                                <div class="text-xs text-gray-300 mt-1">Support</div>
                            </div>
                            <div class="text-center p-3 bg-white/10 backdrop-blur-sm rounded-xl stat-card border border-white/20">
                                <div class="text-2xl font-bold text-white">100%</div>
                                <div class="text-xs text-gray-300 mt-1">Sécurisé</div>
                            </div>
                        </div>
                    </div>

                    <!-- Partie droite - Formulaire -->
                    <div class="p-6 lg:p-10 flex flex-col justify-center ">
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">Bienvenue !</h2>
                            <p class="text-sm text-gray-600">Connectez-vous pour accéder à votre tableau de bord</p>
                        </div>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-3 rounded-xl">
                                <p class="text-sm text-green-700">{{ session('status') }}</p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}" class="space-y-4">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Adresse Email
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                    </div>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                                        class="input-field block w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition-all @error('email') border-red-500 @enderror"
                                        placeholder="exemple@email.com">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Mot de passe
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                    <input id="password" type="password" name="password" required autocomplete="current-password"
                                        class="input-field block w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-purple-400 focus:border-purple-400 transition-all @error('password') border-red-500 @enderror"
                                        placeholder="••••••••">
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            {{-- <div class="flex items-center justify-between">
                                <label for="remember_me" class="flex items-center cursor-pointer group">
                                    <input id="remember_me" type="checkbox" name="remember"
                                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded cursor-pointer">
                                    <span class="ml-2 text-sm text-gray-700 group-hover:text-gray-900 transition-colors">Se souvenir de moi</span>
                                </label>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-purple-600 hover:text-purple-700 transition-colors">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
                            </div> --}}

                            <!-- Submit Button -->
                            <button type="submit" class="btn-login w-full flex justify-center items-center px-4 py-3 text-white font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Se connecter
                            </button>

                            <!-- Lien retour au site -->
                            <div class="mt-4 text-center border-t border-gray-200 pt-4">
                                <a href="{{ route('front.home') }}" class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-purple-600 transition-colors">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Retour au site
                                </a>
                            </div>
                        </form>

                        <!-- Copyright footer -->
                        {{-- <div class="mt-4 text-center">
                            <p class="text-xs text-gray-500">
                                © {{ date('Y') }} <span class="font-semibold">Keneya Impact</span>. Tous droits réservés.
                            </p>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
