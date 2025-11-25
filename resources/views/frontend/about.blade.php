@extends('layouts.frontend.master')

@section('title', isset($seoData['title']) ? $seoData['title'] : __('about.page_title'))
@section('description', isset($seoData['description']) ? $seoData['description'] : __('about.page_description'))

@section('content')
    <!-- ***** Section Principale ***** -->
    @if(isset($mainSection) && $mainSection)
        <section class="about mgt">
            <div class="container-lg">
                <div class="section--title wow fadeInLeft">
                    <h1>{{ $mainSection->about_title ?? __('about.about_us_default') }}</h1>
                </div>
                <div class="part-flex">
                    <!-- left -->
                    <div class="part-flex__left">
                        {{-- CORRECTION : Utiliser Storage::url() pour les images uploadées --}}
                        @if($mainSection->about_image_path)
                            <img src="{{ Storage::url($mainSection->about_image_path) }}"
                                alt="{{ $mainSection->about_image_alt ?? 'À propos de Keneya' }}">
                        @else
                            {{-- Image statique par défaut --}}
                            <img src="{{ asset('images/25.png') }}" alt="À propos de Keneya">
                        @endif
                    </div>

                    <!-- right -->
                    <div class="part-flex__right">
                        @if($mainSection->about_description_1)
                            <p class="wow fadeInRight">{!! $mainSection->about_description_1 !!}</p>
                        @endif

                        @if($mainSection->about_description_2)
                            <p class="wow fadeInRight">{!! $mainSection->about_description_2 !!}</p>
                        @endif

                        @if($mainSection->about_description_3)
                            <p class="wow fadeInRight">{!! $mainSection->about_description_3 !!}</p>
                        @endif

                        @if($mainSection->about_description_4)
                            <p class="wow fadeInRight">{!! $mainSection->about_description_4 !!}</p>
                        @endif

                        @if($mainSection->about_button_text && $mainSection->about_button_link)
                            <a href="{{ $mainSection->about_button_link }}" class="btn-site wow fadeInRight">
                                <span>{{ $mainSection->about_button_text }}</span>
                                <span class="arrow">→</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ***** Accordion ***** -->
    @if(isset($accordionItems) && $accordionItems->count() > 0)
        <section>
            <div class="container-lg">
                <div class="custom-accordion wow fadeInLeft">
                    @foreach($accordionItems as $index => $item)
                        <div class="custom-accordion-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="custom-accordion-header">
                                <h3>{{ $item->about_accordion_title }}</h3>
                                <span class="icon">{{ $index === 0 ? '−' : '+' }}</span>
                            </div>
                            <div class="custom-accordion-body">
                                <p>{!! $item->about_accordion_content !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ***** Section Transition ***** -->
    @if(isset($transitionSection) && $transitionSection)
        <section>
            <div class="container-lg">
                <div class="part-flex">
                    <!-- left -->
                    <div class="part-flex__left">
                        {{-- CORRECTION : Utiliser Storage::url() --}}
                        @if($transitionSection->about_transition_image_path)
                            <img src="{{ Storage::url($transitionSection->about_transition_image_path) }}"
                                alt="{{ $transitionSection->about_transition_image_alt ?? 'Transition' }}">
                        @else
                            <img src="{{ asset('images/placeholder.jpg') }}" alt="Transition">
                        @endif
                    </div>

                    <!-- right -->
                    <div class="part-flex__right">
                        <div class="section--title">
                            <h2>{!! $transitionSection->about_transition_title ?? 'Notre Transition' !!}</h2>
                        </div>

                        @if($transitionSection->about_transition_description_1)
                            <p class="wow fadeInRight">{!! $transitionSection->about_transition_description_1 !!}</p>
                        @endif

                        @if(isset($transitionSection->aboutTransitionListItems) && $transitionSection->aboutTransitionListItems->count() > 0)
                            <ul class="wow fadeInRight">
                                @foreach($transitionSection->aboutTransitionListItems as $listItem)
                                    <li>{{ $listItem->about_transition_list_content }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if($transitionSection->about_transition_description_2)
                            <p class="wow fadeInRight">{!! $transitionSection->about_transition_description_2 !!}</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ***** Section Équipe ***** -->
    @if(isset($teamMembers) && $teamMembers->count() > 0)
        <section class="team-section">
            <div class="container-lg">
                <div class="section--title wow fadeInRight">
                    <h2>{{ $teamSectionTitle ?? __('about.team_section_title') }}</h2>
                </div>

                <div class="swiper team-swiper">
                    <div class="swiper-wrapper">
                        @foreach($teamMembers as $member)
                            <div class="swiper-slide">
                                <a href="{{ $member->about_team_detail_link ?? '#' }}" class="team-card">
                                    {{-- CORRECTION : Utiliser Storage::url() --}}
                                    @if($member->about_team_image_path)
                                        <img src="{{ Storage::url($member->about_team_image_path) }}"
                                            alt="{{ $member->about_team_name ?? 'Membre de l\'équipe' }}">
                                    @else
                                        <img src="{{ asset('images/team-placeholder.jpg') }}"
                                            alt="{{ $member->about_team_name ?? 'Membre de l\'équipe' }}">
                                    @endif
                                    <div class="card-content">
                                        <div class="p-4">
                                            <h3>{{ $member->about_team_name ?? 'Nom du membre' }}</h3>
                                            <p>{{ $member->about_team_position ?? 'Poste' }}</p>
                                        </div>
                                        <span class="arrow p-4"> &#8594; </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <div class="navigation-buttons-swiper">
                        <div class="swiper-button-prev team-prev"></div>
                        <div class="swiper-button-next team-next"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection