@extends('layouts.frontend.master')

@section('title', 'Détails de l\'Équipe - Keneya')
@section('description', 'Découvrez en détail le profil et les réalisations des membres de notre équipe.')

@section('content')
    <section class="team-details mgt">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h2>Équipe dirigeante</h2>
            </div>

            <div class="part-flex">
                <!-- left -->
                <div class="part-flex__left wow fadeInRight">
                    <img src="{{ asset($teamLeader->image) }}" alt="{{ $teamLeader->name }}">

                    <h1>{{ $teamLeader->name }}</h1>
                    <h2>{{ $teamLeader->position }}</h2>
                </div>

                <!-- right -->
                <div class="part-flex__right">
                    @foreach(explode("\n", $teamLeader->description) as $paragraph)
                        @if(trim($paragraph))
                            <p class="wow fadeInLeft">{{ $paragraph }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="team-section">
        <div class="container-lg">
            <div class="section--title wow fadeInRight">
                <h2>Blog d'actualités</h2>
            </div>

            <div class="swiper team-swiper">
                <div class="swiper-wrapper">
                    @foreach($teamMembers as $member)
                    <div class="swiper-slide">
                        <a href="{{ $member->link }}" class="team-card">
                            <img src="{{ asset($member->image) }}" alt="{{ $member->name }}">
                            <div class="card-content">
                                <div class="p-4">
                                    <h3>{{ $member->name }}</h3>
                                    <p>{{ $member->position }}</p>
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
@endsection
