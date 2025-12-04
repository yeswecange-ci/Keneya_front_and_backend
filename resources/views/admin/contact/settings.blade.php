@extends('layouts.admin')

@section('title', 'Paramètres de la Page Contact')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Paramètres de la Page Contact</h1>
            <p class="text-gray-500 mt-1">Gérez l'image, le texte et la localisation de la page de contact</p>
        </div>
        <div>
            <a href="{{ route('dashboard.contact') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Retour aux contacts
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('dashboard.contact.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 space-y-6">

                <!-- Image Section -->
                <div class="border-b pb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Image de la page</h2>

                    <div class="space-y-4">
                        <!-- Current Image Preview -->
                        @if($settings && $settings->image)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Image actuelle</label>
                                <img src="{{ asset($settings->image) }}" alt="Image actuelle" class="w-48 h-auto rounded-lg shadow">
                            </div>
                        @endif

                        <!-- Upload New Image -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                Nouvelle image
                            </label>
                            <input type="file"
                                   id="image"
                                   name="image"
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500">
                            <p class="mt-1 text-sm text-gray-500">PNG, JPG, GIF, SVG (max 2MB)</p>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Text Above Image Section -->
                <div class="border-b pb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Texte au-dessus de l'image</h2>

                    <div class="space-y-4">
                        <!-- French -->
                        <div>
                            <label for="text_above_image_fr" class="block text-sm font-medium text-gray-700 mb-2">
                                Texte (Français)
                            </label>
                            <textarea id="text_above_image_fr"
                                      name="text_above_image_fr"
                                      rows="3"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Entrez le texte en français">{{ old('text_above_image_fr', $settings->text_above_image_fr ?? '') }}</textarea>
                            @error('text_above_image_fr')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- English -->
                        <div>
                            <label for="text_above_image_en" class="block text-sm font-medium text-gray-700 mb-2">
                                Text (English)
                            </label>
                            <textarea id="text_above_image_en"
                                      name="text_above_image_en"
                                      rows="3"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Enter text in English">{{ old('text_above_image_en', $settings->text_above_image_en ?? '') }}</textarea>
                            @error('text_above_image_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Spanish -->
                        <div>
                            <label for="text_above_image_es" class="block text-sm font-medium text-gray-700 mb-2">
                                Texto (Español)
                            </label>
                            <textarea id="text_above_image_es"
                                      name="text_above_image_es"
                                      rows="3"
                                      class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Ingrese el texto en español">{{ old('text_above_image_es', $settings->text_above_image_es ?? '') }}</textarea>
                            @error('text_above_image_es')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Location Section -->
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Localisation (Google Maps)</h2>

                    <div class="space-y-4">
                        <!-- Location URL -->
                        <div>
                            <label for="location_url" class="block text-sm font-medium text-gray-700 mb-2">
                                URL de la carte Google Maps (iframe embed)
                            </label>
                            <input type="url"
                                   id="location_url"
                                   name="location_url"
                                   value="{{ old('location_url', $settings->location_url ?? '') }}"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="https://www.google.com/maps/embed?pb=...">
                            <p class="mt-1 text-sm text-gray-500">Collez l'URL d'intégration depuis Google Maps (Partager &gt; Intégrer une carte)</p>
                            @error('location_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location Text French -->
                        <div>
                            <label for="location_text_fr" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre de la section (Français)
                            </label>
                            <input type="text"
                                   id="location_text_fr"
                                   name="location_text_fr"
                                   value="{{ old('location_text_fr', $settings->location_text_fr ?? '') }}"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Où nous trouver">
                            @error('location_text_fr')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location Text English -->
                        <div>
                            <label for="location_text_en" class="block text-sm font-medium text-gray-700 mb-2">
                                Section Title (English)
                            </label>
                            <input type="text"
                                   id="location_text_en"
                                   name="location_text_en"
                                   value="{{ old('location_text_en', $settings->location_text_en ?? '') }}"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Find us">
                            @error('location_text_en')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location Text Spanish -->
                        <div>
                            <label for="location_text_es" class="block text-sm font-medium text-gray-700 mb-2">
                                Título de la sección (Español)
                            </label>
                            <input type="text"
                                   id="location_text_es"
                                   name="location_text_es"
                                   value="{{ old('location_text_es', $settings->location_text_es ?? '') }}"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="Encuéntranos">
                            @error('location_text_es')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>

            <!-- Form Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t flex justify-end gap-3">
                <a href="{{ route('dashboard.contact') }}"
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors">
                    Annuler
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Enregistrer les modifications
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
