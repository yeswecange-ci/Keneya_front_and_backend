@extends('layouts.app')

@section('content')
 <section class="team-details">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h2>Équipe dirigeante</h2>
            </div>

            <div class="part-flex">
                <!-- left -->
                <div class="part-flex__left wow fadeInRight">
                    <img src="{{asset('images/12.jpg')}}" alt="kids">

                    <h1>Dr Jean-Baptiste GUIARD-SCHMID</h1>
                    <h2>Directeur Général </h2>
                </div>

                <!-- right -->
                <div class="part-flex__right">

                    <p class="wow fadeInLeft">Spécialiste en médecine interne, maladies infectieuses et tropicales et
                        santé publique,
                        Jean-Baptiste Guiard-Schmid possède une solide expertise internationale dans le domaine des
                        Maladies Transmissibles (VIH, TB, Paludisme, Hépatites), de la Santé de la Mère, du Nouveau-né,
                        de l’enfant et de l’adolescent / Santé Sexuelle et Reproductive, du Renforcement des Systèmes de
                        Santé et des Maladies Non Transmissibles en Afrique.
                    </p>

                    <p class="wow fadeInLeft">
                       Son expertise porte sur la planification stratégique, la mobilisation de ressources, la
                       conception, la mise en œuvre, le management et le suivi et évaluation des politiques, programmes
                       et projets de santé dans ces domaines, ainsi que la recherche opérationnelle.
                    </p>

                    <p class="wow fadeInLeft">
                        Depuis plus de 20 ans, il travaille au développement d'une assistance technique africaine de
                        haut niveau en santé publique, engagée dans une approche holistique et durable du renforcement
                        des systèmes de santé et qui engage pleinement les communautés et usagers de la santé. Par le
                        renforcement des capacités des parties prenantes, y compris des populations bénéficiaires, dans
                        les réponses aux défis majeurs pour la santé publique.
                    </p>

                    <p class="wow fadeInLeft">
                        Après 5 années à l'OMS en tant que conseiller régional pour l'Afrique de l'Ouest, il a fondé à
                        Ouagadougou (Burkina Faso) en 2012 Initiatives Conseil International-Santé (ICI-Santé). Il est
                        citoyen français et burkinabè.
                    </p>

                </div>
            </div>
        </div>
    </section>


    <!-- ***** -->
    <section class="team-section">
        <div class="container-lg">
            <div class="section--title wow fadeInRight">
                <h2>Blog d'actualités</h2>
            </div>

            <div class="swiper team-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="team-details.html" class="team-card">
                            <img src="{{asset('images/12.jpg')}}" alt="DR JEAN-BAPTISTE GUIARD-SCHMID">
                            <div class="card-content">
                                <div class="p-4">
                                    <h3>DR JEAN-BAPTISTE GUIARD-SCHMID</h3>
                                    <p>Directeur Général</p>
                                </div>
                                <span class="arrow p-4">&#8594;</span>
                            </div>
                        </a>
                    </div>

                    <!-- ***** -->
                    <div class="swiper-slide">
                        <a href="team-details.html" class="team-card">
                            <img src="{{asset('images/13.jpg')}}" alt="DR BENOIT KAFANDO">
                            <div class="card-content">
                                <div class="p-4">
                                    <h3>DR BENOIT KAFANDO</h3>
                                    <p>Directeur des Programmes</p>
                                </div>
                                <span class="arrow p-4">&#8594;</span>
                            </div>
                        </a>
                    </div>
                    <!-- ***** -->


                    <div class="swiper-slide">
                        <a href="team-details.html" class="team-card">
                            <img src="{{asset('images/14.jpg')}}" alt="MARTIAL SIDWAYAN ZONGO">
                            <div class="card-content">
                                <div class="p-4">
                                    <h3>MARTIAL SIDWAYAN ZONGO</h3>
                                    <p>Directeur Administratif et Financier</p>
                                </div>
                                <span class="arrow p-4">&#8594;</span>
                            </div>
                        </a>
                    </div>

                    <!-- ***** -->

                </div>

                <!-- <div class="navigation-buttons">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div> -->


                <div class="navigation-buttons-swiper">
                    <div class="swiper-button-prev team-prev"></div>
                    <div class="swiper-button-next team-next"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        new Swiper('.team-swiper', {
            slidesPerView: 'auto',
            spaceBetween: 20,
            navigation: {
                nextEl: '.team-next',
                prevEl: '.team-prev',
            },
        });
    </script>
@endpush