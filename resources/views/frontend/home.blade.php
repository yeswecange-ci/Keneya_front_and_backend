{{-- Votre fichier home.blade.php mis à jour --}}
@extends('layouts.frontend.master')

@section('title', 'Accueil - Keneya')
@section('description', 'Bienvenue chez Keneya, votre marque de confiance pour des produits de qualité exceptionnelle.')

@section('content')
    <!-- Messages de succès/erreur -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- header--index -->
    <section class="header-section">
        @if($homeSlides && $homeSlides->count() > 0)
            @foreach($homeSlides as $index => $slide)
                <div class="slide {{ $index === 0 ? 'active' : '' }}" style="background-image: url('{{ asset($slide->home_slide_image) }}');">
                    <div class="container-lg">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="slide-content {{ $index === 0 ? 'wow fadeInLeft' : '' }}">
                                    <!--<small>{{ $slide->home_slide_number }}</small>-->
                                    <div class="section--title">
                                        <h1>{!! $slide->home_slide_title !!}</h1>
                                    </div>
                                    <!--<p>{{ $slide->home_slide_description }}</p>-->

                                    <!--<div class="slide-bar-env">
                                        <div class="slide-bar"></div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Fallback si aucune slide n'est disponible -->
            <div class="slide active" style="background-image: url('img/23.jpg');">
                <div class="container-lg">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="slide-content wow fadeInLeft">
                                <small>01</small>
                                <div class="section--title">
                                    <h1>Contenu par défaut</h1>
                                </div>
                                <p>Aucun contenu disponible pour le moment.</p>
                                <div class="slide-bar-env">
                                    <div class="slide-bar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="scroll-down" onclick="scrollToSection()">
            ↓
        </div>
    </section>

    <!-- À propos -->
    <section class="about" id="next-section">
        <div class="container-lg">
            @if($homeAbout)
                <div class="section--title wow fadeInRight">
                    <h2>{{ $homeAbout->home_about_section_title }}</h2>
                    <h1>{!! $homeAbout->home_about_main_title !!}</h1>
                </div>

                <div class="wow fadeInLeft">
                    <p>{!! $homeAbout->home_about_description !!}</p>

                    <a href="{{ $homeAbout->home_about_button_link }}" class="btn-site">
                        <span>{{ $homeAbout->home_about_button_text }}</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            @else
                <!-- Fallback -->
                <div class="section--title wow fadeInRight">
                    <h2>À propos de nous</h2>
                    <h1>Contenu par défaut</h1>
                </div>
                
                <div class="wow fadeInLeft">
                    <p>Aucun contenu disponible pour le moment.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Chiffres clés -->
    <section class="knumb">
        <div class="container-lg">
            <div class="knumb-card">
                <!-- left -->
                <div class="knumb-card__left">
                    @if($homeKeyNumbers)
                        <img src="{{ asset($homeKeyNumbers->home_key_numbers_image) }}" alt="key numbers image">
                    @else
                        <img src="{{ asset('img/kids.jpg') }}" alt="default image">
                    @endif
                </div>

                <!-- right -->
                <div class="knumb-card__right">
                    @if($homeKeyNumbers)
                        <div class="section--title wow fadeInLeft">
                            <h2>{{ $homeKeyNumbers->home_key_numbers_section_title }}</h2>
                        </div>

                        <p class="wow fadeInLeft">{{ $homeKeyNumbers->home_key_numbers_description }}</p>

                        <!-- Stats elements -->
                        <div class="knumb--elts my-5">
                            @if($homeKeyNumbers->activeStats && $homeKeyNumbers->activeStats->count() > 0)
                                @foreach($homeKeyNumbers->activeStats as $stat)
                                    <div class="knumb--elts__elt wow fadeInRight">
                                        <h1>
                                            <img src="{{ asset($stat->home_stat_icon) }}" alt="stat icon">
                                            {{ $stat->home_stat_number }}
                                        </h1>
                                        <p>{{ $stat->home_stat_description }}</p>
                                    </div>
                                @endforeach
                            @else
                                <!-- Fallback stats -->
                                <div class="knumb--elts__elt wow fadeInRight">
                                    <h1><img src="{{ asset('img/6.png') }}" alt="img"> 700</h1>
                                    <p>Missions d'assistance technique mise en oeuvre</p>
                                </div>
                            @endif
                        </div>

                        <a href="{{ $homeKeyNumbers->home_key_numbers_button_link }}" class="btn-site wow fadeInRight">
                            <span>{{ $homeKeyNumbers->home_key_numbers_button_text }}</span>
                            <span class="arrow">→</span>
                        </a>
                    @else
                        <!-- Fallback -->
                        <div class="section--title wow fadeInLeft">
                            <h2>Nos chiffres clés</h2>
                        </div>
                        <p class="wow fadeInLeft">Aucun contenu disponible pour le moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Section candidature -->
   <!-- <section>
        <div class="container-lg">
            @if($homeRecruitment)
                <div class="section--title wow fadeInLeft">
                    <h2>{{ $homeRecruitment->home_recruitment_section_title }}</h2>
                </div>
                <p class="wow fadeInLeft">{{ $homeRecruitment->home_recruitment_description }}</p>
            @else
                <div class="section--title wow fadeInLeft">
                    <h2>Venez travailler avec nous</h2>
                </div>
                <p class="wow fadeInLeft">Merci de remplir ce formulaire, afin de postuler pour les positions disponibles dans notre cabinet.</p>
            @endif

            <div action="{{ route('home.application.store') }}" method="POST" enctype="multipart/form-data" class="form-candidature wow fadeInRight">
                @csrf

                <input type="text" name="home_application_first_name" placeholder="Prénom" value="{{ old('home_application_first_name') }}" required>
                @error('home_application_first_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <input type="text" name="home_application_last_name" placeholder="Nom de famille" value="{{ old('home_application_last_name') }}" required>
                @error('home_application_last_name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <div class="row-double">
                    <div>
                        <input type="email" name="home_application_email" placeholder="Email" value="{{ old('home_application_email') }}" required>
                        @error('home_application_email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <input type="tel" name="home_application_phone" placeholder="Téléphone" value="{{ old('home_application_phone') }}" required>
                        @error('home_application_phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <select name="home_application_desired_position" required>
                    <option value="">Poste souhaité</option>
                    <option value="Développeur" {{ old('home_application_desired_position') == 'Développeur' ? 'selected' : '' }}>Développeur</option>
                    <option value="Designer" {{ old('home_application_desired_position') == 'Designer' ? 'selected' : '' }}>Designer</option>
                    <option value="Assistant" {{ old('home_application_desired_position') == 'Assistant' ? 'selected' : '' }}>Assistant</option>
                    <option value="Consultant" {{ old('home_application_desired_position') == 'Consultant' ? 'selected' : '' }}>Consultant</option>
                    <option value="Chef de projet" {{ old('home_application_desired_position') == 'Chef de projet' ? 'selected' : '' }}>Chef de projet</option>
                </select>
                @error('home_application_desired_position')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <input type="date" name="home_application_availability_date" placeholder="Date de disponibilité" value="{{ old('home_application_availability_date') }}" required>
                @error('home_application_availability_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <label class="file-upload">
                    <input type="file" name="home_application_cv" accept=".pdf,.doc,.docx" required>
                    <span>Ajouter votre CV</span>
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cloud-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M7.646 5.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 6.707V10.5a.5.5 0 0 1-1 0V6.707L6.354 7.854a.5.5 0 1 1-.708-.708z" />
                            <path
                                d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z" />
                        </svg>
                    </span>
                </label>
                @error('home_application_cv')
                    <small class="text-danger">{{ $message }}</small>
                @enderror

                <button type="button" onclick="submitApplication()" class="btn-site1">
                    <span>Postuler</span>
                    <span class="arrow">→</span>
                </button>
            </div>
        </div>
    </section>-->

    <!-- Section testimonial -->
    <section>
        <div class="container-lg">
            <div class="section--title wow fadeInRight">
                <h2>ILS NOUS FONT CONFIANCE</h2>
            </div>


             <div class="swiper partners-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{asset('images/27.png')}}" alt="img">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{asset('images/27.png')}}" alt="img">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{asset('images/27.png')}}" alt="img">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{asset('images/27.png')}}" alt="img">
                    </div>

                    <div class="swiper-slide">
                        <img src="{{asset('images/27.png')}}" alt="img">
                    </div>
                </div>


                <div class="navigation-buttons-swiper">
                    <div class="swiper-button-prev partners-prev"></div>
                    <div class="swiper-button-next partners-next"></div>
                </div>
            </div>
        </div>
    </section>


    <!-- NOUVEAU: Inclusion du composant cookies -->
    @include('components.cookies-banner')

@endsection

@section('scripts')

    

    <script>
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                    const bar = slide.querySelector('.slide-bar');
                    if (bar) {
                        bar.style.animation = 'none';
                        void bar.offsetWidth;
                        bar.style.animation = 'barSlide 10s linear forwards';
                    }
                }
            });
        }

        if (slides.length > 1) {
            setInterval(() => {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }, 10000);
        }

        function scrollToSection() {
            document.getElementById('next-section').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Fonction pour soumettre le formulaire avec gestion des cookies
        function submitApplication() {
            const form = document.querySelector('.form-candidature');
            const formData = new FormData();

            // Récupérer tous les champs du formulaire
            const inputs = form.querySelectorAll('input, select');
            inputs.forEach(input => {
                if (input.type === 'file') {
                    if (input.files[0]) {
                        formData.append(input.name, input.files[0]);
                    }
                } else {
                    formData.append(input.name, input.value);
                }
            });

            // Ajouter le token CSRF
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

            // Envoyer la requête
            fetch('{{ route("home.application.store") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Candidature envoyée avec succès !');
                    form.reset();
                } else {
                    alert('Erreur lors de l\'envoi de la candidature');
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors de l\'envoi');
            });
        }
    </script>
@endsection
