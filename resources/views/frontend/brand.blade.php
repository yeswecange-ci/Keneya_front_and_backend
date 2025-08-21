@extends('frontend.layouts.app')

@section('title', 'Notre Marque - Keneya')
@section('description', 'Découvrez l\'histoire et les valeurs de Keneya, une marque engagée pour la qualité et
    l\'authenticité.')

@section('content')
    <div class="min-h-screen">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-green-600 to-blue-600 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Notre Marque</h1>
                    <p class="text-xl md:text-2xl max-w-3xl mx-auto">
                        L'histoire d'une passion pour l'authenticité et la qualité
                    </p>
                </div>
            </div>
        </section>

        <!-- Story Section -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-6">Notre Histoire</h2>
                        <p class="text-lg text-gray-700 mb-4">
                            Keneya est née d'une vision simple : préserver et partager les trésors culinaires
                            de l'Afrique tout en respectant les plus hauts standards de qualité.
                        </p>
                        <p class="text-lg text-gray-700 mb-4">
                            Depuis notre création, nous nous engageons à travailler directement avec les
                            producteurs locaux pour vous offrir des produits authentiques et durables.
                        </p>
                        <p class="text-lg text-gray-700">
                            Chaque produit Keneya raconte une histoire, celle de traditions millénaires
                            adaptées aux exigences modernes.
                        </p>
                    </div>
                    <div class="h-96 bg-gray-200 rounded-lg flex items-center justify-center">
                        <span class="text-gray-500">Image de l'histoire de la marque</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Valeurs</h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                        Les principes qui guident chacune de nos actions
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Authenticité</h3>
                        <p class="text-gray-600">
                            Préserver l'essence des traditions culinaires africaines
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Qualité</h3>
                        <p class="text-gray-600">
                            Des standards élevés pour chaque produit
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Durabilité</h3>
                        <p class="text-gray-600">
                            Respect de l'environnement et des communautés
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Communauté</h3>
                        <p class="text-gray-600">
                            Soutenir les producteurs et artisans locaux
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-blue-600 text-white rounded-2xl p-12 text-center">
                    <h2 class="text-3xl font-bold mb-6">Notre Mission</h2>
                    <p class="text-xl max-w-4xl mx-auto">
                        Rendre accessible au monde entier la richesse des saveurs africaines,
                        tout en créant un impact positif sur les communautés locales et
                        en préservant notre patrimoine culinaire pour les générations futures.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
