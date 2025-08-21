@extends('layouts.app')

@section('content')
    <div class="login-body">
        <div class="login-container">
            <div class="wow fadeInLeft">
                <div class="login-logo">
                    <img src="{{asset('images/Logo.png')}}" alt="Logo Kenaya Impact">
                </div>
                <h1 class="login-title">CONNEXION</h1>
                <p class="login-subtitle">Bonjour, bienvenue à l’espace expert</p>
            </div>

            <form class="wow fadeInRight">
                <div class="form-group">
                    <span class="icon">@</span>
                    <input type="text" placeholder="Nom d’utilisateur">
                </div>

                <div class="form-group">
                    <span class="icon">**</span>
                    <input type="password" placeholder="Mot de passe">
                </div>

                <button class="btn-site1 mt-0 w-100 justify-content-center">
                    <span>Postuler</span>
                    <span class="arrow">→</span>
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
   
@endpush