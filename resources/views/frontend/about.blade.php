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
                                <div class="team-card" style="cursor: pointer;" onclick="openTeamMemberModal({{ $member->id }})">
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
                                </div>
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

        <!-- Modal Team Member -->
        <div id="teamMemberModal" class="team-modal" style="display: none;">
            <div class="team-modal-overlay" onclick="closeTeamMemberModal()"></div>
            <div class="team-modal-content">
                <button class="team-modal-close" onclick="closeTeamMemberModal()">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <div class="team-modal-body">
                    <div class="team-modal-image">
                        <img id="modalMemberImage" src="" alt="">
                    </div>
                    <div class="team-modal-info">
                        <h2 id="modalMemberName"></h2>
                        <p class="team-modal-position" id="modalMemberPosition"></p>
                        <p class="team-modal-description" id="modalMemberDescription"></p>

                        <div class="team-modal-socials" id="modalMemberSocials">
                            <!-- Les liens des réseaux sociaux seront insérés ici -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .team-modal {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 9999;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 1rem;
            }

            .team-modal-overlay {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.75);
                backdrop-filter: blur(4px);
            }

            .team-modal-content {
                position: relative;
                background: white;
                border-radius: 16px;
                max-width: 800px;
                width: 100%;
                max-height: 90vh;
                overflow-y: auto;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
                animation: modalFadeIn 0.3s ease-out;
            }

            @keyframes modalFadeIn {
                from {
                    opacity: 0;
                    transform: scale(0.95) translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: scale(1) translateY(0);
                }
            }

            .team-modal-close {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: white;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
                transition: all 0.2s;
                z-index: 10;
            }

            .team-modal-close:hover {
                background: #f3f4f6;
                transform: scale(1.1);
            }

            .team-modal-body {
                display: grid;
                grid-template-columns: 1fr 1.5fr;
                gap: 2rem;
                padding: 2rem;
            }

            @media (max-width: 768px) {
                .team-modal-body {
                    grid-template-columns: 1fr;
                }
            }

            .team-modal-image {
                display: flex;
                align-items: flex-start;
                justify-content: center;
            }

            .team-modal-image img {
                width: 100%;
                max-width: 300px;
                aspect-ratio: 1;
                object-fit: cover;
                border-radius: 12px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .team-modal-info h2 {
                font-size: 1.875rem;
                font-weight: bold;
                color: #111827;
                margin-bottom: 0.5rem;
            }

            .team-modal-position {
                font-size: 1.125rem;
                color: #6b7280;
                margin-bottom: 1.5rem;
                font-weight: 500;
            }

            .team-modal-description {
                font-size: 1rem;
                line-height: 1.75;
                color: #4b5563;
                margin-bottom: 2rem;
            }

            .team-modal-socials {
                display: flex;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .team-modal-socials a {
                display: inline-flex;
                align-items: center;
                gap: 0.625rem;
                padding: 0.75rem 1.5rem;
                text-decoration: none;
                border-radius: 10px;
                font-size: 0.9375rem;
                font-weight: 600;
                transition: all 0.3s ease;
                border: 2px solid transparent;
            }

            .team-modal-socials a:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            }

            .team-modal-socials svg {
                width: 22px;
                height: 22px;
                flex-shrink: 0;
            }

            /* Facebook */
            .team-modal-socials a[data-social="facebook"] {
                background: #1877F2;
                color: white;
            }

            .team-modal-socials a[data-social="facebook"]:hover {
                background: #0d65d9;
                box-shadow: 0 8px 20px rgba(24, 119, 242, 0.35);
            }

            /* Twitter */
            .team-modal-socials a[data-social="twitter"] {
                background: #1DA1F2;
                color: white;
            }

            .team-modal-socials a[data-social="twitter"]:hover {
                background: #0c8bd9;
                box-shadow: 0 8px 20px rgba(29, 161, 242, 0.35);
            }

            /* LinkedIn */
            .team-modal-socials a[data-social="linkedin"] {
                background: #0A66C2;
                color: white;
            }

            .team-modal-socials a[data-social="linkedin"]:hover {
                background: #084d94;
                box-shadow: 0 8px 20px rgba(10, 102, 194, 0.35);
            }

            /* Instagram */
            .team-modal-socials a[data-social="instagram"] {
                background: linear-gradient(45deg, #F58529, #DD2A7B, #8134AF, #515BD4);
                color: white;
            }

            .team-modal-socials a[data-social="instagram"]:hover {
                background: linear-gradient(45deg, #dd6e1a, #c91d67, #6d2a94, #3e45b8);
                box-shadow: 0 8px 20px rgba(221, 42, 123, 0.35);
            }
        </style>

        <script>
            const teamMembersData = @json($teamMembers);

            function openTeamMemberModal(memberId) {
                const member = teamMembersData.find(m => m.id === memberId);
                if (!member) return;

                document.getElementById('modalMemberName').textContent = member.about_team_name;
                document.getElementById('modalMemberPosition').textContent = member.about_team_position;
                document.getElementById('modalMemberDescription').textContent = member.about_team_description || '';
                document.getElementById('modalMemberImage').src = member.about_team_image_path
                    ? `/storage/${member.about_team_image_path}`
                    : '/images/team-placeholder.jpg';

                // Construire les liens des réseaux sociaux
                const socialsContainer = document.getElementById('modalMemberSocials');
                socialsContainer.innerHTML = '';

                const socials = [
                    { name: 'Facebook', key: 'facebook', url: member.about_team_facebook, icon: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>' },
                    { name: 'Twitter', key: 'twitter', url: member.about_team_twitter, icon: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>' },
                    { name: 'LinkedIn', key: 'linkedin', url: member.about_team_linkedin, icon: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>' },
                    { name: 'Instagram', key: 'instagram', url: member.about_team_instagram, icon: '<svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/></svg>' }
                ];

                socials.forEach(social => {
                    if (social.url) {
                        const link = document.createElement('a');
                        link.href = social.url;
                        link.target = '_blank';
                        link.rel = 'noopener noreferrer';
                        link.setAttribute('data-social', social.key);
                        link.innerHTML = `${social.icon} ${social.name}`;
                        socialsContainer.appendChild(link);
                    }
                });

                document.getElementById('teamMemberModal').style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function closeTeamMemberModal() {
                document.getElementById('teamMemberModal').style.display = 'none';
                document.body.style.overflow = '';
            }

            // Fermer la modal avec la touche Escape
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeTeamMemberModal();
                }
            });
        </script>
    @endif
@endsection