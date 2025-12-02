@extends('layouts.frontend.master')

@section('title', 'Détails de l\'Équipe - Keneya')
@section('description', 'Découvrez en détail le profil et les réalisations des membres de notre équipe.')

@section('content')
    <!--<section class="team-details mgt">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h2>Notre équipe</h2>
            </div>

            <div class="part-flex">
                <div class="part-flex__left wow fadeInRight">
                    <img src="{{ asset($teamLeader->image) }}" alt="{{ $teamLeader->name }}">

                    <h1>{{ $teamLeader->name }}</h1>
                    <h2>{{ $teamLeader->position }}</h2>
                </div>

                <div class="part-flex__right">
                    @foreach(explode("\n", $teamLeader->description) as $paragraph)
                        @if(trim($paragraph))
                            <p class="wow fadeInLeft">{{ $paragraph }}</p>
                            <p class="wow fadeInLeft">
                                Spécialiste en médecine interne, maladies infectieuses et tropicales et santé publique, Jean-Baptiste Guiard-Schmid possède une solide expertise internationale dans le domaine des Maladies Transmissibles (VIH, TB, Paludisme, Hépatites), de la Santé de la Mère, du Nouveau-né, de l’enfant et de l’adolescent / Santé Sexuelle et Reproductive, du Renforcement des Systèmes de Santé et des Maladies Non Transmissibles en Afrique. <br><br> Son expertise porte sur la planification stratégique, la mobilisation de ressources, la conception, la mise en œuvre, le management et le suivi et évaluation des politiques, programmes et projets de santé dans ces domaines, ainsi que la recherche opérationnelle. Depuis plus de 20 ans, il travaille au développement d'une assistance technique africaine de haut niveau en santé publique, engagée dans une approche holistique et durable du renforcement des systèmes de santé et qui engage pleinement les communautés et usagers de la santé. Par le renforcement des capacités des parties prenantes, y compris des populations bénéficiaires, dans les réponses aux défis majeurs pour la santé publique. <br><br> Après 5 années à l'OMS en tant que conseiller régional pour l'Afrique de l'Ouest, il a fondé à Ouagadougou (Burkina Faso) en 2012 Initiatives Conseil International-Santé (ICI-Santé). Il est citoyen français et burkinabè.
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>-->



    @if($expertSpaceSection)
    <div class="team-details mgt">
        <img src="{{ asset($expertSpaceSection->image) }}" alt="Expert Space" class="team-details-imgDoc">

        <div class="container-lg my-5 wow fadeInLeft">
            <div class="section--title">
                <h2>{{ $expertSpaceSection->title }}</h2>
            </div>

            <p>{!! $expertSpaceSection->description !!}</p>

            @if($expertSpaceSection->button_text && $expertSpaceSection->button_link)
                <a href="{{ $expertSpaceSection->button_link }}" class="btn-site">
                    <span>{{ $expertSpaceSection->button_text }}</span>
                    <span class="arrow">→</span>
                </a>
            @endif
        </div>
    </div>
    @endif

   <!-- <section class="team-section">
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
    </section>-->
@endsection
