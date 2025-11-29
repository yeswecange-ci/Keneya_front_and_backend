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
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-container {
            animation: float 2s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .input-field {
            transition: all 0.2s ease;
            border: 1px solid #e5e7eb;
        }

        .input-field:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Loader spinner */
        .spinner {
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: #ffffff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .btn-login:disabled {
            opacity: 0.8;
            cursor: not-allowed;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="h-screen flex items-center justify-center p-4">
        <!-- Container principal -->
        <div class="w-full max-w-xl">
            <div class="login-card bg-white shadow-2xl rounded-2xl p-6 lg:p-8">
                <!-- Logo -->
                <div class="text-center mb-4 logo-container">
                    <img src="{{ asset('img/logo1.png') }}" alt="Keneya Logo" class="w-16 h-auto mx-auto mb-2">
                    <h1 class="text-xl font-bold text-gray-900 mb-1">Bienvenue sur Keneya Impact</h1>
                    <p class="text-sm text-gray-500">Connectez-vous pour accéder à votre espace</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-3 bg-green-50 border-l-4 border-green-500 p-2.5 rounded">
                        <p class="text-sm text-green-700">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-3">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Adresse Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            class="input-field block w-full px-4 py-2 rounded-lg text-gray-900 placeholder-gray-400 @error('email') border-red-500 @enderror"
                            placeholder="exemple@email.com">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                            Mot de passe
                        </label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="input-field block w-full px-4 py-2 rounded-lg text-gray-900 placeholder-gray-400 @error('password') border-red-500 @enderror"
                            placeholder="••••••••">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="loginBtn" class="btn-login w-full flex justify-center items-center px-4 py-2.5 text-white font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 mt-4">
                        <span id="btnContent">
                            Se connecter
                        </span>
                        <span id="btnLoader" class="hidden flex items-center">
                            <div class="spinner mr-2"></div>
                            Connexion...
                        </span>
                    </button>
                </form>

                <!-- Lien retour au site -->
                <div class="mt-4 text-center border-t border-gray-100 pt-4">
                    <a href="{{ route('front.home') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                        ← Retour au site
                    </a>
                </div>

                <!-- Copyright footer -->
                <div class="mt-3 text-center">
                    <p class="text-xs text-gray-400">
                        © {{ date('Y') }} Keneya Impact. Tous droits réservés.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Écouter la soumission du formulaire
        document.querySelector('form').addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const btn = document.getElementById('loginBtn');

            // Vérifier que les champs sont remplis
            if (email && password) {
                // Désactiver le bouton
                btn.disabled = true;

                // Afficher le loader et cacher le contenu
                document.getElementById('btnContent').classList.add('hidden');
                document.getElementById('btnLoader').classList.remove('hidden');

                // Le formulaire se soumet automatiquement après cette fonction
            }
        });
    </script>
</body>
</html>
