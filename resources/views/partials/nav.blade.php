 <!-- Navbar part -->
    <div class="navigation navigation1">
        <div class="container-lg">
            <div class="img-logo">
                <a href="index.html">
                    <img src="{{asset('images/logo1.png')}}" alt="logo">
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
                        <li><a href="about.html" class="navSelect">À PROPOS DE NOUS</a> <i class="fa-solid fa-arrow-right"></i></li>
                        <li><a href="activities.html">NOS ACTIVITÉS</a><i class="fa-solid fa-arrow-right"></i></li>
                        <li><a href="news.html">ACTUALITÉS</a><i class="fa-solid fa-arrow-right"></i></li>
                        <li><a href="team-details.html">ESPACE EXPERTS</a><i class="fa-solid fa-arrow-right"></i></li>
                        <li><a href="contact.html">CONTACT</a><i class="fa-solid fa-arrow-right"></i></li>

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
                                      <a href="#"><img src="{{asset('images/1.png')}}" alt="Facebook"></a>
                                      <a href="#"><img src="{{asset('images/2.png')}}" alt="X"></a>
                                      <a href="#"><img src="{{asset('images/3.png')}}" alt="Instagram"></a>
                                      <a href="#"><img src="{{asset('images/4.png')}}" alt="YouTube"></a>
                                      <a href="#"><img src="{{asset('images/5.png')}}" alt="LinkedIn"></a>
                                  </div>
                              </div>
                        </li>
                    </ul>
                </ul>
            </div>

           
        </div>
    </div>
    <!-- ***** -->