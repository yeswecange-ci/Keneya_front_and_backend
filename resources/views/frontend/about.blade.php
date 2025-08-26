@extends('layouts.frontend.master')

@section('title', 'À Propos - Keneya')
@section('description',
    'Découvrez l\'histoire et les valeurs de Keneya, une organisation engagée pour l\'impact social
    et le développement communautaire.')

@section('content')
    <!-- ***** Section Principale ***** -->
    @if(isset($mainSection) && $mainSection)
    <section class="about mgt">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h1>{{ $mainSection->about_title }}</h1>
            </div>
            <div class="part-flex">
                <!-- left -->
                <div class="part-flex__left">
                    <img src="{{ $mainSection->about_image_path }}" alt="kids">
                </div>

                <!-- right -->
                <div class="part-flex__right">
                    <p class="wow fadeInRight">{!! $mainSection->about_description_1 !!}</p>
                    <p class="wow fadeInRight">{!! $mainSection->about_description_2 !!}</p>
                    <p class="wow fadeInRight">{!! $mainSection->about_description_3 !!}</p>
                    <p class="wow fadeInRight">{!! $mainSection->about_description_4 !!}</p>

                    <a href="{{ $mainSection->about_button_link }}" class="btn-site wow fadeInRight">
                        <span>{{ $mainSection->about_button_text }}</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ***** Accordion ***** -->
    @if(isset($accordionItems) && $accordionItems && $accordionItems->count() > 0)
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
                    <img src="{{ $transitionSection->about_transition_image_path }}" alt="transition">
                </div>

                <!-- right -->
                <div class="part-flex__right">
                    <div class="section--title">
                        <h2>{!! $transitionSection->about_transition_title !!}</h2>
                    </div>

                    <p class="wow fadeInRight">{!! $transitionSection->about_transition_description_1 !!}</p>

                    @if($transitionSection->aboutTransitionListItems->count() > 0)
                    <ul class="wow fadeInRight">
                        @foreach($transitionSection->aboutTransitionListItems as $listItem)
                        <li>{{ $listItem->about_transition_list_content }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <p class="wow fadeInRight">{!! $transitionSection->about_transition_description_2 !!}</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ***** Section Équipe ***** -->
    @if(isset($teamMembers) && $teamMembers && $teamMembers->count() > 0)
    <section class="team-section">
        <div class="container-lg">
            <div class="section--title wow fadeInRight">
                <h2>Blog d'actualités</h2>
            </div>

            <div class="swiper team-swiper">
                <div class="swiper-wrapper">
                    @foreach($teamMembers as $member)
                    <div class="swiper-slide">
                        <a href="{{ $member->about_team_detail_link }}" class="team-card">
                            <img src="{{ $member->about_team_image_path }}" alt="{{ $member->about_team_name }}">
                            <div class="card-content">
                                <div class="p-4">
                                    <h3>{{ $member->about_team_name }}</h3>
                                    <p>{{ $member->about_team_position }}</p>
                                </div>
                                <span class="arrow p-4">&#8594;</span>
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
