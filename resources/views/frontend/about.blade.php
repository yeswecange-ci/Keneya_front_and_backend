@extends('layouts.frontend.master')

@section('title', 'À Propos - Keneya')
@section('description',
    'Découvrez l\'histoire et les valeurs de Keneya, une organisation engagée pour l\'impact social
    et le développement communautaire.')

@section('content')
    <!-- ***** -->
    <section class="about">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h1>À propos de nous</h1>
            </div>
            <div class="part-flex">
                <!-- left -->
                <div class="part-flex__left">
                    <img src="img/10.jpg" alt="kids">
                </div>

                <!-- right -->
                <div class="part-flex__right">

                    <p class="wow fadeInRight">Créé en 2012 sous l’impulsion du Dr. Jean-Baptiste
                        Guiard-Schmid, <strong>KENAYA Impact</strong>
                        (anciennement
                        appelée Initiatives Conseil International-Santé (ICI-Santé)) est un leader Africain dans
                        l’assistance technique pour faire émerger des solutions de santé publique innovantes et
                        durables.
                    </p>

                    <p class="wow fadeInRight">
                        <strong>KENAYA Impact</strong> est fondé sur la conviction qu’il est vital de développer et
                        renforcer l'expertise
                        Africaine dans le domaine de la santé, afin de la porter au plus haut niveau d'excellence afin
                        de la mettre au service de la santé des habitants du continent.
                    </p>

                    <p class="wow fadeInRight">
                        <strong>KENAYA Impact</strong> dispose d’une expertise internationalement reconnue dans la
                        riposte aux pandémies
                        et aux maladies non transmissibles, ainsi que dans le renforcement de systèmes de santé durables
                        en Afrique.
                    </p>

                    <p class="wow fadeInRight">
                        Son équipe et ses experts participent, à un niveau élevé, aux instances décisionnelles et de
                        réforme sectorielle du secteur de la santé aux plans international, régional, national et local.
                        Avec un siège situé à Ouagadougou (Burkina Faso), <strong>KENAYA Impact</strong> dispose déjà de
                        représentations
                        au Mali, au Niger, au Nigéria et au Tchad.
                    </p>



                    <a href="#" class="btn-site wow fadeInRight">
                        <span>Découvrir nos domaines d'intervention</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- accordion -->
    <section>
        <div class="container-lg">
            <div class="custom-accordion wow fadeInLeft">
                <div class="custom-accordion-item active">
                    <div class="custom-accordion-header">
                        <h3>Mission</h3>
                        <span class="icon">−</span>
                    </div>
                    <div class="custom-accordion-body">
                        <p>
                            Mobiliser et mettre à disposition l’expertise pour la conception, le développement,
                            la mise en œuvre et le suivi-évaluation des réponses adaptées aux problèmes
                            de santé des populations.
                        </p>
                    </div>
                </div>

                <div class="custom-accordion-item">
                    <div class="custom-accordion-header">
                        <h3>Vision</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="custom-accordion-body">
                        <p>Notre vision ici…</p>
                    </div>
                </div>

                <div class="custom-accordion-item">
                    <div class="custom-accordion-header">
                        <h3>Valeurs</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="custom-accordion-body">
                        <p>Nos valeurs ici…</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- *** -->

    <section>
        <div class="container-lg">
            <div class="part-flex">
                <!-- left -->
                <div class="part-flex__left">
                    <img src="img/11.jpg" alt="kids">
                </div>

                <!-- right -->
                <div class="part-flex__right">

                    <div class="section--title">
                        <h2>Transition ICI-Santé <br> Kenaya Impact</h2>
                    </div>

                    <p class="wow fadeInRight">Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae
                        ac non varius nec.
                        Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum .
                    </p>

                    <p>
                    <ul class=" wow fadeInRight">
                        <li>Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pr</li>
                        <li>etium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet.</li>
                        <li>Massa scelerisque pellentesque condimentum</li>
                    </ul>
                    </p>

                    <p class="wow fadeInRight">
                        Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec.
                        Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum ..
                    </p>

                </div>
            </div>
        </div>
    </section>

    <!-- ***Teams*** -->
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
                            <img src="img/12.jpg" alt="DR JEAN-BAPTISTE GUIARD-SCHMID">
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
                            <img src="img/13.jpg" alt="DR BENOIT KAFANDO">
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
                            <img src="img/14.jpg" alt="MARTIAL SIDWAYAN ZONGO">
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
