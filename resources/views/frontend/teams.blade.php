@extends('layouts.frontend.master')

@section('title', 'Notre Équipe - Keneya')
@section('description', 'Rencontrez les membres dévoués de l\'équipe Keneya qui travaillent pour créer un impact positif.')

@section('content')
    <div class="min-h-screen mgt">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-green-600 to-teal-600 text-white py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Notre Équipe</h1>
                    <p class="text-xl md:text-2xl max-w-3xl mx-auto">
                        Des professionnels passionnés unis par une vision commune
                    </p>
                </div>
            </div>
        </section>

        <!-- Leadership Team -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Direction</h2>
                    <p class="text-lg text-gray-600">
                        L'équipe dirigeante qui guide notre vision et notre stratégie
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    @foreach($leadership as $member)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                            <div class="h-64 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-white font-semibold text-lg">Photo {{ $member->name }}</span>
                                @endif
                            </div>
                            <div class="p-6 text-center">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $member->name }}</h3>
                                <p class="text-blue-600 font-medium mb-3">{{ $member->position }}</p>
                                <p class="text-gray-600 text-sm">{{ $member->description }}</p>
                                <div class="mt-4 flex justify-center space-x-3">
                                    @if($member->linkedin)
                                        <a href="{{ $member->linkedin }}" class="text-blue-600 hover:text-blue-800">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M16.338 16.338H13.67V12.16c0-.995-.017-2.277-1.387-2.277-1.39 0-1.601 1.086-1.601 2.207v4.248H8.014v-8.59h2.559v1.174h.037c.356-.675 1.227-1.387 2.526-1.387 2.703 0 3.203 1.778 3.203 4.092v4.711zM5.005 6.575a1.548 1.548 0 11-.003-3.096 1.548 1.548 0 01.003 3.096zm-1.337 9.763H6.34v-8.59H3.667v8.59zM17.668 1H2.328C1.595 1 1 1.581 1 2.298v15.403C1 18.418 1.595 19 2.328 19h15.34c.734 0 1.332-.582 1.332-1.299V2.298C19 1.581 18.402 1 17.668 1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    @endif
                                    @if($member->twitter)
                                        <a href="{{ $member->twitter }}" class="text-blue-400 hover:text-blue-600">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84">
                                                </path>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Core Team -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Équipe Opérationnelle</h2>
                    <p class="text-lg text-gray-600">
                        Les professionnels qui mettent en œuvre nos programmes au quotidien
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($operational as $member)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden text-center">
                            <div class="h-48 bg-gradient-to-br from-green-400 to-teal-500 flex items-center justify-center">
                                @if($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-white font-medium">Photo {{ $member->name }}</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $member->name }}</h3>
                                <p class="text-blue-600 text-sm font-medium mb-2">{{ $member->position }}</p>
                                <p class="text-gray-600 text-xs">{{ $member->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Volunteers Section -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Bénévoles</h2>
                    <p class="text-lg text-gray-600">
                        Le cœur battant de notre organisation
                    </p>
                </div>

                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white text-center">
                    <div class="max-w-3xl mx-auto">
                        <h3 class="text-2xl font-bold mb-4">Plus de 50 bénévoles actifs</h3>
                        <p class="text-lg mb-6">
                            Nos bénévoles sont des membres essentiels de notre équipe. Ils apportent leurs compétences,
                            leur passion et leur temps pour soutenir nos missions dans toutes les communautés où nous
                            intervenons.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            @foreach($stats as $stat)
                                <div>
                                    <div class="text-3xl font-bold mb-2">{{ $stat->value }}</div>
                                    <p class="text-sm">{{ $stat->title }}</p>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('front.contact') }}"
                            class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                            Devenir bénévole
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Values Section -->
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Nos Valeurs d'Équipe</h2>
                    <p class="text-lg text-gray-600">
                        Ce qui nous unit et guide notre travail au quotidien
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($values as $value)
                        <div class="text-center">
                            <div class="w-16 h-16 bg-{{ $value->color }}-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <!-- Icône selon la valeur -->
                                    @if($value->icon == 'users')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    @elseif($value->icon == 'heart')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    @elseif($value->icon == 'check-circle')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    @endif
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold mb-2">{{ $value->title }}</h3>
                            <p class="text-gray-600 text-sm">{{ $value->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
