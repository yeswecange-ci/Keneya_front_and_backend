@extends('layouts.app')

@section('content')
<!-- header--index -->
    <section class="header-section">
        <div class="slide active" style="background-image: url('{{ asset('images/23.jpg') }}');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-md-8">
                        <div class="slide-content wow fadeInLeft ">
                            <small>01</small>
                            <div class="section--title">
                                <h1>Formulation des programmes<br>et projets de santé</h1>
                            </div>
                            <p>
                                Nous disposons d’une expertise internationalement reconnue dans la riposte aux pandémies
                                et aux maladies non transmissibles
                            </p>

                            <div class="slide-bar-env">
                                <div class="slide-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slide" style="background-image: url('{{ asset('images/24.jpg')}}');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-md-8">
                        <div class="slide-content">
                            <small>02</small>
                            <div class="section--title">
                                <h1>Formulation des programmes<br>et projets de santé</h1>
                            </div>
                            <p>
                                Nous disposons d’une expertise internationalement reconnue dans la riposte aux
                                pandémies
                                et aux maladies non transmissibles
                            </p>

                            <div class="slide-bar-env">
                                <div class="slide-bar"></div>
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

    <!-- a propos -->
    <section class="about" id="next-section">
        <div class="container-lg">
            <div class="section--title wow fadeInRight">
                <h2>À propos de nous</h2>
                <h1>Créé en 2012 sous l’impulsion du <br> Dr. Jean-Baptiste Guiard-Schmid,</h1>
            </div>

            <div class="wow fadeInLeft">
                <p><strong>KENAYA Impact</strong> (anciennement appelée Initiatives Conseil International-Santé
                    (ICI-Santé))
                    est un leader Africain dans l’assistance technique pour faire émerger des solutions de santé
                    publique
                    innovantes et durables.</p>

                <a href="#" class="btn-site">
                    <span>En savoir plus</span>
                    <span class="arrow">→</span>
                </a>
            </div>
        </div>
    </section>

    <!-- *** -->

    <!-- key-numbers -->
    <section class="knumb">
        <div class="container-lg ">
            <div class="knumb-card">
                <!-- left -->
                <div class="knumb-card__left">
                    <img src="{{asset('images/kids.jpg')}}" alt="kids">
                </div>

                <!-- right -->
                <div class="knumb-card__right">
                    <div class="section--title wow fadeInLeft">
                        <h2>Nos chiffres clés</h2>
                    </div>

                    <p class="wow fadeInLeft">Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec.
                        Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum ..
                    </p>

                    <!-- knumb elements -->
                    <div class="knumb--elts my-5">
                        <div class="knumb--elts__elt wow fadeInRight">
                            <h1><img src="{{ asset('images/6.png')}}" alt="img"> 700</h1>
                            <p>Missions d'assistance technique mise en oeuvre</p>
                        </div>

                        <div class="knumb--elts__elt wow fadeInRight">
                            <h1><img src="{{ asset('images/7.png') }}" alt="img"> 50</h1>
                            <p>Pays africains bénéficiaires</p>
                        </div>

                        <div class="knumb--elts__elt wow fadeInRight">
                            <h1><img src="{{ asset('images/8.png') }}" alt="img"> 400</h1>
                            <p>Consultants internationaux mobilisés</p>
                        </div>
                    </div>

                    <a href="#" class="btn-site wow fadeInRight">
                        <span>Découvrir nos domaines d'intervention</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- *** -->

    <section>
        <div class="container-lg">
            <div class="section--title wow fadeInLeft ">
                <h2>Venez travailler avec nous</h2>
            </div>
            <p class="wow fadeInLeft">Merci  de remplir ce formulaire, afin de  postuler pour les positions disponibles dans notre cabinet.</p>

            <!-- formulaire -->
            <form class="form-candidature wow fadeInRight">
                <input type="text" placeholder="Prénom" required>
                <input type="text" placeholder="Nom de famille" required>

                <div class="row-double">
                    <input type="email" placeholder="Email" required>
                    <input type="tel" placeholder="Téléphone" required>
                </div>

                <select required>
                    <option value="">Poste souhaité</option>
                    <option>Développeur</option>
                    <option>Designer</option>
                    <option>Assistant</option>
                </select>

                <input type="date" placeholder="Date de disponibilité" required>

                <label class="file-upload">
                    <input type="file" required>
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

                <button class="btn-site1">
                    <span>Postuler</span>
                    <span class="arrow">→</span>
                </button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        const slides = document.querySelectorAll('.slide');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove('active');
                if (i === index) {
                    slide.classList.add('active');
                    const bar = slide.querySelector('.slide-bar');
                    bar.style.animation = 'none';
                    void bar.offsetWidth;
                    bar.style.animation = 'barSlide 10s linear forwards';
                }
            });
        }

        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 10000);

        function scrollToSection() {
            document.getElementById('next-section').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
@endpush