@extends('layouts.frontend.master')

@section('title', $pageContent['title'] ?? 'Activités - Keneya')
@section('description',
    $pageContent['description'] ??
    'Découvrez nos différentes activités et programmes pour le
    développement communautaire.')

@section('content')
    <!-- header--index -->
    <section class="header-section">
        <div class="slide active" style="background-image: url('{{ $pageContent['hero_image'] ?? 'img/24.jpg' }}');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-md-8">
                        <div class="slide-content wow fadeInLeft ">
                            <div class="section--title">
                                <h1>{{ $pageContent['hero_title'] ?? 'Nos activités' }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="scroll-down" onclick="scrollToSection()">
            ↓
        </div>
    </section>

    <section class="knumb-card__activities">
        <div class="container-lg">
            <div class="position-relative">
                <div class="knumb-card__right">
                    <!-- knumb elements -->
                    <div class="knumb--elts">
                        @foreach ($keyNumbers as $keyNumber)
                            <div class="knumb--elts__elt wow fadeInRight">
                                <h1>
                                    @if ($keyNumber->activities_keynumber_icon)
                                        <img src="{{ asset($keyNumber->activities_keynumber_icon) }}"
                                            alt="{{ $keyNumber->activities_keynumber_title }}">
                                    @endif
                                    {{ $keyNumber->activities_keynumber_value }}
                                </h1>
                                <p>{{ $keyNumber->activities_keynumber_description ?? $keyNumber->activities_keynumber_title }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** -->
    <section class="domains-activities" id="next-section">
        <div class="container-lg">
            <div class="section--title  wow fadeInRight">
                <h2>{{ $pageContent['themes_section_title'] ?? 'Domaines thématique d’expertise ' }}</h2>
            </div>
            <div class="part-flex">
                <!-- left -->
                <div class="part-flex__left">
                    <img src="{{ $pageContent['themes_section_image'] ?? 'img/15.jpg' }}" alt="kids">
                </div>

                <!-- right -->
                <div class="part-flex__right">
                    <div class="knumb--elts my-5">
                        @foreach ($themes as $theme)
                            <div class="knumb--elts__elt wow fadeInLeft">
                                <img src="{{ $theme->activities_theme_icon ?? 'img/16.png' }}"
                                    alt="{{ $theme->activities_theme_title }}">
                                <div>
                                    <h1>{{ $theme->activities_theme_title }}</h1>
                                    @if ($theme->activities_theme_description)
                                        <p>{{ $theme->activities_theme_description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ $pageContent['contact_button_url'] ?? '#' }}" class="btn-site wow fadeInLeft">
                        <span>{{ $pageContent['contact_button_text'] ?? 'Contactez nous' }}</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** -->
    <section class="service-offer">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="section--title  wow fadeInRight">
                        <h2>{{ $pageContent['services_section_title'] ?? 'Notre offre de services en santé et protection sociale' }}
                        </h2>
                    </div>
                </div>

                <div class="col-md-12 col-lg-8">
                    <div class="swiper offer-swiper wow fadeInRight">
                        <div class="swiper-wrapper">
                            @foreach ($services as $index => $service)
                                <div class="swiper-slide">
                                    <div class="card-offers">
                                        <div class="card-image-offer"
                                            style="background: url('{{ $service->activities_service_image ?? 'img/12.jpg' }}');">
                                            <!-- <img src="" alt="Image santé" class="card-img" > -->
                                        </div>
                                        <div class="card-content-offer">
                                            <small>{{ sprintf('%02d', $index + 1) }}</small>
                                            <h3>{{ $service->activities_service_title }}</h3>
                                            @if ($service->activities_service_features)
                                                @php
                                                    $features = is_string($service->activities_service_features)
                                                        ? json_decode($service->activities_service_features, true)
                                                        : $service->activities_service_features;
                                                @endphp
                                                @if ($features && is_array($features))
                                                    <ul>
                                                        @foreach ($features as $feature)
                                                            <li>{{ $feature }}</li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="navigation-buttons-swiper">
                            <div class="swiper-button-prev offer-prev"></div>
                            <div class="swiper-button-next offer-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- sectionnn map -->
    <section class="domain-map">
        <div class="container-lg">
            <div class="row align-items-center  wow fadeInLeft">
                <div class="col-md-6 ">
                    <div class="section--title">
                        <h2>{{ $geographicCoverage->activities_geographic_title ?? 'Couverture géographique' }}</h2>
                        <p>{{ $geographicCoverage->activities_geographic_description ?? 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.' }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="domain-map__map" id="map">
                        <div class="domain-map__map--image">
                            @if ($geographicCoverage && $geographicCoverage->activities_geographic_map_svg)
                                {!! $geographicCoverage->activities_geographic_map_svg !!}
                            @else
                                <!-- SVG par défaut -->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:amcharts="http://amcharts.com/ammap"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 612 585">
                                    <g>
                                        <path id="AO" title="Angola" class="land" d="M521.03,479.78l0.69,2.09l0.8,1.68l0.64,0.91l1.07,1.47l1.85,-0.23l0.93,-0.4l1.55,0.4l0.42,-0.7l0.7,-1.64l1.74,-0.11l0.15,-0.49l1.43,-0.01l-0.24,1.01l3.4,-0.02l0.05,1.77l0.57,1.09l-0.41,1.7l0.21,1.74l0.94,1.05l-0.15,3.37l0.69,-0.26l1.22,0.07l1.74,-0.42l1.28,0.17l0.3,0.88l-0.32,1.38l0.49,1.34l-0.42,1.07l0.24,0.99l-5.84,-0.04l-0.13,9.16l1.89,2.38l1.83,1.82l-5.15,1.19l-6.79,-0.41l-1.94,-1.4l-11.37,0.13l-0.42,0.21l-1.67,-1.32l-1.82,-0.09l-1.68,0.5l-1.35,0.56l-0.26,-1.83l0.39,-2.55l0.97,-2.65l0.15,-1.24l0.91,-2.59l0.67,-1.17l1.61,-1.87l0.9,-1.27l0.29,-2.11l-0.15,-1.61l-0.84,-1.01l-0.75,-1.72l-0.69,-1.69l0.15,-0.59l0.86,-1.12l-0.85,-2.72l-0.57,-1.88l-1.4,-1.77l0.27,-0.54l1.16,-0.38l0.81,0.05l0.98,-0.34L521.03,479.78zM510.12,479.24l-0.71,0.3l-0.75,-2.1l1.13,-1.21l0.85,-0.47l1.05,0.96l-1.02,0.59l-0.46,0.72L510.12,479.24z" />
                                    </g>
                                </svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- temoignages -->
    <section class="temoignages">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h2>{{ $pageContent['testimonials_section_title'] ?? 'Études de cas/témoignages' }}</h2>
            </div>

            <div class="swiper temoignages-swiper wow fadeInRight">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="cardBlog">
                                <a href="{{ $testimonial->activities_testimonial_link ?? '#' }}">
                                    <div class="cardBlog--img">
                                        <img src="{{ $testimonial->activities_testimonial_image ?? 'img/21.jpg' }}"
                                            alt="{{ $testimonial->activities_testimonial_title }}">
                                    </div>

                                    <div class="cardBlog--body">
                                        <h3>{{ $testimonial->activities_testimonial_title }}</h3>
                                        <p>{{ Str::limit($testimonial->activities_testimonial_description, 200) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($testimonials->count() > 1)
                    <div class="navigation-buttons-swiper">
                        <div class="swiper-button-prev temoignages-prev"></div>
                        <div class="swiper-button-next temoignages-next"></div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function scrollToSection() {
            document.getElementById('next-section').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
@endsection