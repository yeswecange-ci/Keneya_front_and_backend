<!-- Navbar part -->
<div class="navigation navigation1">
    <div class="container-lg">
        <div class="img-logo">
            <a href="{{ route('front.home') }}">
                <img src="{{ asset('img/logo1.png') }}" alt="logo">
            </a>
        </div>

        <button class="menu-toggle" id="menuToggle" aria-label="Menu">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <!-- **** -->

        <div class="menu" id="menu">
            <ul>
                <ul>
                    <li>
                        <a href="{{ route('front.about') }}" class="{{ Request::is('about') ? 'navSelect' : '' }}">À
                            PROPOS DE NOUS</a>
                        <i class="fa-solid fa-arrow-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('front.activities') }}"
                            class="{{ Request::is('activities') ? 'navSelect' : '' }}">NOS
                            ACTIVITÉS</a>
                        <i class="fa-solid fa-arrow-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('front.news') }}"
                            class="{{ Request::is('news') ? 'navSelect' : '' }}">ACTUALITÉS</a>
                        <i class="fa-solid fa-arrow-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('front.team.details') }}"
                            class="{{ Request::is('team-details') ? 'navSelect' : '' }}">ESPACE
                            EXPERTS</a>
                        <i class="fa-solid fa-arrow-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('front.contact') }}"
                            class="{{ Request::is('contact') ? 'navSelect' : '' }}">CONTACT</a>
                        <i class="fa-solid fa-arrow-right"></i>
                    </li>

                    <li>
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <div class="lang-container">
                                <div class="lang-switcher" id="langSwitcher">
                                    <span id="currentLang">FR ▼</span>
                                    <div class="lang-options" id="langOptions">
                                        <a href="#" data-lang="FR">FR</a>
                                        <a href="#" data-lang="EN">EN</a>
                                        <a href="#" data-lang="ES">ES</a>
                                    </div>
                                </div>
                            </div>

                            <div class="footer-social">
                                <a href="#"><img src="img/1.png" alt="Facebook"></a>
                                <a href="#"><img src="img/2.png" alt="X"></a>
                                <a href="#"><img src="img/3.png" alt="Instagram"></a>
                                <a href="#"><img src="img/4.png" alt="YouTube"></a>
                                <a href="#"><img src="img/5.png" alt="LinkedIn"></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </ul>



            <!-- <ul class="part-icon">
                    <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                </ul> -->
        </div>

        <!-- *** -->
        <!-- <div class="lang-container">
                <div class="lang-switcher">
                    FR ▼
                    <div class="lang-options">
                        <a href="#" data-lang="fr">FR</a>
                        <a href="#" data-lang="en">EN</a>
                        <a href="#" data-lang="es">ES</a>
                    </div>
                </div>
            </div> -->
        <!-- <div class="menu--enter">
                <i class="fa fa-bars"></i>
            </div> -->
    </div>
</div>
<!-- ***** -->
