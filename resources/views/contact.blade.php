@extends('layouts.app')

@section('content')
 <!-- Contact -->
    <section class="contact mgt">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h1>Contact</h1>
                <h2>Venez travailler avec nous</h2>
            </div>

            <p class="wow fadeInRight">Merci  de remplir ce formulaire, afin de  postuler pour les positions disponibles dans notre cabinet.</p>
        </div>

        <!-- *** -->
        <img src="{{asset('img/25.png')}}" alt="img-people" class="img--contact wow fadeInLeft">

        <!-- *** -->
        <div class="container-lg">
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
        
        <img src="{{asset('img/25.png')}}" alt="img-people" class="img--contact1 wow fadeInLeft">

    </section>
    <!-- *** -->

    <section class="findUs">
        <div class="container-lg wow fadeInRight">
            <div class="section--title">
                <h2>Nous trouver</h2>
            </div>

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16801.114518740127!2d-3.9994224484780414!3d5.312937414646711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ebf60b2e34af%3A0xa62c41360300c47!2sMarcory%20Residentiel%2C%20Abidjan!5e1!3m2!1sfr!2sci!4v1754061918651!5m2!1sfr!2sci"
                width="100%" height="361" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- **** -->
    <section>
        <div class="container-lg wow fadeInLeft">
            <div class="section--title">
                <h2>Demander un devis</h2>
            </div>

            <form class="form-candidature">
                <input type="text" placeholder="Prénom" required>
                <input type="text" placeholder="Nom de famille" required>

                <div class="row-double">
                    <input type="email" placeholder="Email" required>
                    <input type="tel" placeholder="Téléphone" required>
                </div>

                <textarea name="" id="" placeholder="Détaillez votre demande"></textarea>

                <button class="btn-site1">
                    <span>Demander un devis</span>
                    <span class="arrow">→</span>
                </button>
            </form>
        </div>
    </section>
@endsection

@push('scripts')
    
@endpush