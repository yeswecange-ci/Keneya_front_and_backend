@extends('layouts.frontend.master')

@section('title', $pageContent['title'] ?? 'Activités - Keneya')
@section('description',
    $pageContent['description'] ??
    'Découvrez nos différentes activités et programmes pour le
    développement communautaire.')

@section('content')
    <!-- header--index -->
    <section class="header-section">
        <div class="slide active" style="background-image: url('{{ $pageContent['hero_image'] ?? 'img/24.jpg' }}');">
            <div class="container-lg">
                <div class="row">
                    <div class="col-md-8">
                        <div class="slide-content wow fadeInLeft ">
                            <div class="section--title">
                                <h1>{{ $pageContent['hero_title'] ?? 'Nos activités' }}</h1>
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

    <section class="knumb-card__activities">
        <div class="container-lg">
            <div class="position-relative">
                <div class="knumb-card__right">
                    <!-- knumb elements -->
                    <div class="knumb--elts">
                        @foreach ($keyNumbers as $keyNumber)
                            <div class="knumb--elts__elt wow fadeInRight">
                                <h1>
                                    @if ($keyNumber->activities_keynumber_icon)
                                        <img src="{{ asset($keyNumber->activities_keynumber_icon) }}"
                                            alt="{{ $keyNumber->activities_keynumber_title }}">
                                    @endif
                                    {{ $keyNumber->activities_keynumber_value }}
                                </h1>
                                <p>{{ $keyNumber->activities_keynumber_description ?? $keyNumber->activities_keynumber_title }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** -->
    <section class="domains-activities" id="next-section">
        <div class="container-lg">
            <div class="section--title  wow fadeInRight">
                <h2>{{ $pageContent['themes_section_title'] ?? 'Domaines thématique d’expertise ' }}</h2>
            </div>
            <div class="part-flex">
                <!-- left -->
                <div class="part-flex__left">
                    <img src="{{ $pageContent['themes_section_image'] ?? 'img/15.jpg' }}" alt="kids">
                </div>

                <!-- right -->
                <div class="part-flex__right">
                    <div class="knumb--elts my-5">
                        @foreach ($themes as $theme)
                            <div class="knumb--elts__elt wow fadeInLeft">
                                <img src="{{ asset($theme->activities_theme_icon ?? 'img/16.png') }}"
                                    alt="{{ $theme->activities_theme_title }}">
                                <div>
                                    <h1>{{ $theme->activities_theme_title }}</h1>
                                    @if ($theme->activities_theme_description)
                                        <p>{{ $theme->activities_theme_description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ $pageContent['contact_button_url'] ?? '#' }}" class="btn-site wow fadeInLeft">
                        <span>{{ $pageContent['contact_button_text'] ?? 'Contactez nous' }}</span>
                        <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ***** -->
    <section class="service-offer">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-12 col-lg-4">
                    <div class="section--title  wow fadeInRight">
                        <h2>{{ $pageContent['services_section_title'] ?? 'Notre offre de services en santé et protection sociale' }}
                        </h2>
                    </div>
                </div>

                <div class="col-md-12 col-lg-8">
                    <div class="swiper offer-swiper wow fadeInRight">
                        <div class="swiper-wrapper">
                            @foreach ($services as $index => $service)
                                <div class="swiper-slide">
                                    <div class="card-offers">
                                        <div class="card-image-offer"
                                            style="background: url('{{ asset($service->activities_service_image ?? 'img/12.jpg') }}');">
                                            <!-- <img src="" alt="Image santé" class="card-img" > -->
                                        </div>
                                        <div class="card-content-offer">
                                            <small>{{ sprintf('%02d', $index + 1) }}</small>
                                            <h3 style="cursor: pointer;" onclick="openServiceModal({{ $service->id }})">{{ $service->activities_service_title }}</h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="navigation-buttons-swiper">
                            <div class="swiper-button-prev offer-prev"></div>
                            <div class="swiper-button-next offer-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Service Offer -->
    <div id="serviceOfferModal" class="service-offer-modal" style="display: none;">
        <div class="service-offer-modal-overlay" onclick="closeServiceModal()"></div>
        <div class="service-offer-modal-content">
            <button class="service-offer-modal-close" onclick="closeServiceModal()">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            <div class="service-offer-modal-body">
                <h2 id="modalServiceTitle"></h2>
                <p id="modalServiceDescription"></p>

                <div id="modalServicePdfContainer" style="margin-top: 2rem; display: none;">
                    <a id="modalServicePdfLink" href="#" target="_blank" class="btn-download-pdf">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Télécharger le PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .service-offer-modal {
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

        .service-offer-modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.75);
            backdrop-filter: blur(4px);
        }

        .service-offer-modal-content {
            position: relative;
            background: white;
            border-radius: 16px;
            max-width: 700px;
            width: 100%;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: modalFadeIn 0.3s ease-out;
            padding: 2.5rem;
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

        .service-offer-modal-close {
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

        .service-offer-modal-close:hover {
            background: #f3f4f6;
            transform: scale(1.1);
        }

        .service-offer-modal-body h2 {
            font-size: 1.875rem;
            font-weight: bold;
            color: #111827;
            margin-bottom: 1.5rem;
        }

        .service-offer-modal-body p {
            font-size: 1rem;
            line-height: 1.75;
            color: #4b5563;
            white-space: pre-line;
        }

        .btn-download-pdf {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.25);
        }

        .btn-download-pdf:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(102, 126, 234, 0.35);
        }

        .btn-download-pdf svg {
            width: 20px;
            height: 20px;
        }
    </style>

    <script>
        const servicesData = @json($services);

        function openServiceModal(serviceId) {
            const service = servicesData.find(s => s.id === serviceId);
            if (!service) return;

            document.getElementById('modalServiceTitle').textContent = service.activities_service_title;
            document.getElementById('modalServiceDescription').textContent = service.activities_service_description || 'Aucune description disponible.';

            // Gérer le PDF
            const pdfContainer = document.getElementById('modalServicePdfContainer');
            const pdfLink = document.getElementById('modalServicePdfLink');

            if (service.activities_service_pdf_path) {
                pdfLink.href = '/storage/' + service.activities_service_pdf_path;
                pdfContainer.style.display = 'block';
            } else {
                pdfContainer.style.display = 'none';
            }

            document.getElementById('serviceOfferModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeServiceModal() {
            document.getElementById('serviceOfferModal').style.display = 'none';
            document.body.style.overflow = '';
        }

        // Fermer avec Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeServiceModal();
            }
        });
    </script>

    <!-- sectionnn map -->
    <section class="domain-map">
        <div class="container-lg">
            <div class="row align-items-center  wow fadeInLeft">
                <div class="col-md-6 ">
                    <div class="section--title">
                        <h2>{{ $geographicCoverage->activities_geographic_title ?? 'Couverture géographique' }}</h2>
                        <p>{{ $geographicCoverage->activities_geographic_description ?? 'Lorem ipsum dolor sit amet consectetur. Eget at lacus quis pretium vitae ac non varius nec. Feugiat praesent facilisi neque sollicitudin amet. Massa scelerisque pellentesque condimentum.' }}
                        </p>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="domain-map__map" id="map">
                        <div class="domain-map__map--image">
                            @if ($geographicCoverage && $geographicCoverage->activities_geographic_map_svg)
                                {!! $geographicCoverage->activities_geographic_map_svg !!}
                            @else
                                <!-- SVG par défaut -->
                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#"
                                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg"
                                xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                                xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                                enable_background="new 0 0 1000 1001" height="1001px" pretty_print="False"
                                style="stroke-linejoin: round; stroke:#000; fill: none;" version="1.1"
                                viewBox="0 0 1000 1001" width="1000px" id="svg2" inkscape:version="0.48.4 r9939"
                                sodipodi:docname="africa.svg">
                                <sodipodi:namedview pagecolor="#ffffff" bordercolor="#666666" borderopacity="1"
                                    objecttolerance="10" gridtolerance="10" guidetolerance="10" inkscape:pageopacity="0"
                                    inkscape:pageshadow="2" inkscape:window-width="640" inkscape:window-height="480"
                                    id="namedview68" showgrid="false" inkscape:zoom="0.33342098" inkscape:cx="603.38628"
                                    inkscape:cy="543.55784" inkscape:window-x="1456" inkscape:window-y="314"
                                    inkscape:window-maximized="0" inkscape:current-layer="svg2" />
                                <defs id="defs4">
                                    <style type="text/css" id="style6">
                                        path {
                                            fill-rule: evenodd;
                                        }
                                    </style>
                                </defs>
                                <metadata id="metadata8">
                                    <views id="views10">
                                        <view h="1001" padding="0" w="1000" id="view12">
                                            <proj flip="auto" id="robinson" lon0="100.0" />
                                            <bbox h="1210.83" w="1011.29" x="-258.56" y="-626.99" id="bbox15" />
                                        </view>
                                    </views>
                                    <rdf:RDF>
                                        <cc:Work rdf:about="">
                                            <dc:format>image/svg+xml</dc:format>
                                            <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                                        </cc:Work>
                                    </rdf:RDF>
                                </metadata>
                                <path inkscape:connector-curvature="0" id="AO" data-name="Angola" data-id="AO"
                                    data-bs-toggle="tooltip" data-bs-title="Angola"
                                    d="m 495.3,598.6 -36,-0.2 -4.3,1.7 -3.5,-0.3 -5.1,1.9 -1.1,2.7 6,8.7 2.4,9.3 3.6,13.4 -3.8,5.5 -0.6,2.8 2.9,8.3 3.1,8.4 3.6,5 0.6,7.8 -1.4,10.3 -4,6.1 -7.1,9.1 -2.9,5.6 -4.1,12.5 -0.8,5.9 -4.3,12.7 -1.9,12.2 1,8.7 5.9,-2.7 7.2,-2.3 7.8,0.4 7.1,6.3 1.9,-1 48.8,-0.6 8.2,6.6 29.1,2 22.4,-5.7 -7.6,-8.6 -7.8,-11.3 1.6,-44 25.3,0.1 -1,-4.7 2,-5.2 -2,-6.5 1.5,-6.7 -1.2,-4.3 -5.5,-0.8 -7.6,2 -5.3,-0.3 -3,1.3 0.9,-16.5 -3.9,-5.1 -0.8,-8.5 1.9,-8.4 -2.4,-5.3 -0.1,-8.7 -14.8,0.1 1.1,-5 -6.2,0.1 -0.7,2.4 -7.6,0.5 -3.1,8.1 -1.9,3.4 -6.7,-1.9 -4,1.9 -8.1,1.1 -4.6,-7.2 -2.7,-4.5 -3.5,-8.3 -2.9,-10.3 z m -47.4,-2.7 0.4,-6 2,-3.5 4.5,-2.9 -4.6,-4.8 -3.7,2.3 -5,6 3.3,10.4 3.1,-1.5 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="BI" data-name="Burundi" data-id="BI"
                                    data-bs-toggle="tooltip" title="Burundi"
                                    d="m 669,556.1 -0.6,-5.4 0,0 -6.5,-0.9 -3.8,7.9 -7.4,-1.1 3,6.3 0.1,2.4 4.3,13.2 0,0.6 1.2,-0.2 4.5,-5 4.9,-7.2 3,-2.9 -0.1,-4.5 -2.6,-3.2 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="BJ" data-name="Benin" data-id="BJ"
                                    data-bs-toggle="tooltip" title="Benin"
                                    d="m 340,356 -9.3,-8 -4.3,0.1 -4.1,4 -2.6,4.2 -6,1.2 -2.5,6.1 -4.1,1.6 -1.6,7.2 3.7,4.1 4.3,4.9 0.4,6.8 2.5,2.8 -0.5,31.8 3,9.5 10.1,-1.6 0.6,-22.3 -0.3,-8.8 2.3,-8.7 3.7,-4.3 5.9,-8.5 -1.3,-3.7 2.4,-5.6 -2.8,-8.2 0.5,-4.6 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="BF" data-name="Burkina Faso"
                                    data-id="BF" data-bs-toggle="tooltip" title="Burkina Faso"
                                    d="m 300.7,310.8 -7.8,0 -3,-2.6 -6.7,1.9 -11.3,5.8 -2.3,4.3 -9.4,6.2 -1.7,3.6 -5.1,2.8 -5.8,-1.9 -3.4,3.4 -1.8,9.5 -9.7,11.4 0.3,4.7 -3.4,5.9 0.8,8 5.5,3 2.1,4.6 5.4,2.9 4.3,-3.4 5.7,-0.6 8.3,3.6 -1.6,-10.4 0.3,-7.9 21.1,-0.6 5.4,1 3.9,-2.2 5.6,1.1 10.7,0.3 4.1,-1.6 2.5,-6.1 6,-1.2 2.6,-4.2 0.3,-9.5 -14,-3.1 -0.4,-6.7 -6.9,-9 -1.6,-6.3 1,-6.7 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="BW" data-name="Botswana"
                                    data-id="BW" data-bs-toggle="tooltip" title="Botswana"
                                    d="m 600.6,762.7 -2.2,-1 -6.9,3.1 -3.6,0 -7.9,5.4 -4.4,-5.7 -18.7,4.9 -9,0.4 -1.9,49.3 -11.8,0.5 -1.4,40.4 3.2,2 6.5,13.2 -1.5,8.4 2.5,4.9 8.5,-1.4 6.2,-6.2 5.8,-4.2 3.2,-6.6 6,-3.2 4.9,1.7 5.5,3.9 9.6,0.6 7.8,-3.2 1.4,-4.3 2.4,-6.6 6.5,-1.1 3.9,-5.2 4.4,-9.3 11.2,-10.3 17.3,-10.2 -7.3,-6.2 -9.2,-2.1 -3.1,-8.8 0.2,-4.9 -5.1,-1.5 -13,-15.2 -3.5,-8 -2.3,-2.4 -4.2,-11.1 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="CF" data-name="Central African Rep."
                                    data-id="CF" data-bs-toggle="tooltip" title="Central African Rep."
                                    d="m 587,398.1 -1,-0.7 -4.2,-4 -0.9,-4.3 1.9,-5.7 -0.1,-5.7 -7.2,-8.6 -1.5,-5.9 -7.7,2.3 -6,5.6 -8.6,15.1 -11.3,6.4 -11.8,-0.8 -3.4,1.2 1.2,4.9 -6.3,4.8 -5.1,5.4 -15.3,5.3 -3,-3.1 -2.1,-0.3 -2.2,3.6 -10,1 -6.1,14 -2.9,2.6 -0.8,10.7 1.2,5.8 -0.9,4.1 5.8,7.3 1,4.9 4.6,7.2 5.6,4.4 0.6,6.3 1.3,4 6.3,-12.8 7.3,-7.4 8.2,2.4 7.9,0.7 1,-9.6 4.7,-7.1 6.5,-4.4 10.1,4.7 7.8,5.1 9,1.4 9.1,2.7 3.6,-8.4 1.6,-1.1 5.6,1.4 13.5,-6.9 4.9,3 3.9,-0.5 1.8,-3.3 4.5,-1.2 9.2,1.4 7.9,0.4 4,-1.5 -2,-4.4 -9.2,-5.5 -3.2,-8.3 -5.2,-6 -8.3,-7.2 -0.1,-4.5 -6.8,-5.5 -8.4,-5.4 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="CI" data-name="Côte d'Ivoire"
                                    data-id="CI" data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                    data-bs-toggle="tooltip" data-bs-title="Côte d'Ivoire"
                                    d="m 230.4,373.8 -5,2.1 -2.9,1.7 -1.8,-5.9 -3.5,1.6 -2.1,-0.3 -2.3,4 -9.4,-0.1 -3.3,-2.1 -1.6,1.3 -2.5,1.1 -1,4.7 2.8,5.7 3,11.1 -4.6,1.6 -1.1,1.9 0.9,2.7 -0.8,6.1 -1.9,0 -0.6,4 1.2,6.7 -2.7,6.1 3.6,3.8 3.8,0.9 5.2,5.8 0.3,5.5 -1.1,1.7 -1,11.4 2.3,0.4 12.1,-5.1 8.5,-4 14.5,-2.4 7.8,-0.2 8.5,2.7 5.6,-0.1 0.5,-5.5 -5.2,-11.9 3.2,-15.6 5.1,-11.6 -3.2,-19.7 -8.3,-3.6 -5.7,0.6 -4.3,3.4 -5.4,-2.9 -2.1,-4.6 -5.5,-3 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="CM" data-name="Cameroon"
                                    data-id="CM" data-bs-toggle="tooltip" title="Cameroon"
                                    d="m 477.5,366.6 0.4,-9.2 -1,-9.1 -4.9,-8.9 -3.4,0.8 -0.4,4.4 4.9,5.5 -1.3,2.5 -0.5,4.6 -10.2,10.7 -3.1,8.8 -1.6,7.2 -2.6,3.1 -2.4,9.7 -6.4,5.7 -1.9,7 -2.7,5.6 -1.1,5.7 -8.3,4.7 -6.9,-5.7 -4.6,0.2 -7.2,8.1 -3.6,0.1 -5.7,13.4 -3.1,9.8 -0.1,3.8 3.1,2 2.5,6.2 5.6,2.3 4.8,9.2 -1.8,10.9 19.9,0.3 5.8,-0.9 7.4,1.9 7.3,-1.8 1.5,0.7 15.4,0.6 9.9,3.6 9.7,3.3 0.9,-7.5 -1.3,-4 -0.6,-6.3 -5.6,-4.4 -4.6,-7.2 -1,-4.9 -5.8,-7.3 0.9,-4.1 -1.2,-5.8 0.8,-10.7 2.9,-2.6 6.1,-14 1.8,-3.7 -3.9,-9.6 -1.8,-5.7 -5.3,-2.3 -7.2,-8.1 2.5,-6.5 5.6,1.3 3.4,-0.9 6.8,0.1 -6.8,-12.6 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="CD" data-name="Dem. Rep. Congo"
                                    data-id="CD" data-bs-toggle="tooltip" title="Dem. Rep. Congo"
                                    d="m 618.3,446 -9.2,-1.4 -4.5,1.2 -1.8,3.3 -3.9,0.5 -4.9,-3 -13.5,6.9 -5.6,-1.4 -1.6,1.1 -3.6,8.4 -9.1,-2.7 -9,-1.4 -7.8,-5.1 -10.1,-4.7 -6.5,4.4 -4.7,7.1 -1,9.6 -0.7,8.4 -3.6,7.4 -2.4,8.6 -1.5,12.3 0.7,7.8 -2,4.8 -0.3,5.1 -1.4,4.4 -8.1,6.7 -5.6,7.1 -5.3,13.4 0.3,11.4 -3.1,4.4 -7.2,6.8 -7.2,8.7 -4.5,-2.5 -0.8,-3.9 -6.6,-0.1 -4.2,5.3 -3.2,-1.4 -4.5,2.9 -2,3.5 -0.4,6 -3.1,1.5 1.6,4.3 5.1,-1.9 3.5,0.3 4.3,-1.7 36,0.2 2.9,10.3 3.5,8.3 2.7,4.5 4.6,7.2 8.1,-1.1 4,-1.9 6.7,1.9 1.9,-3.4 3.1,-8.1 7.6,-0.5 0.7,-2.4 6.2,-0.1 -1.1,5 14.8,-0.1 0.1,8.7 2.4,5.3 -1.9,8.4 0.8,8.5 3.9,5.1 -0.9,16.5 3,-1.3 5.3,0.3 7.6,-2 5.5,0.8 4.2,0.3 0.6,4.3 5.7,-0.3 7.7,1.3 3.9,6.2 9.7,2 7.5,-4.4 2.6,7.3 9.2,1.9 4.3,5.9 4.8,7.6 9.3,0.1 -0.6,-14.9 -3.4,2.5 -8.4,-5.4 -3.2,-2.4 1.9,-13.9 2.5,-16.4 -2.6,-6.1 3.6,-8.8 3.3,-1.7 16.4,-2.3 2.1,0.6 0.6,-2.3 -3.4,-3.7 -1.5,-7.6 -7.3,-7.6 -4.1,-9.9 2.3,-5.8 -3.2,-7.8 2.4,-22.1 0.1,0.2 -0.1,-2.4 -3,-6.3 1.2,-7.6 1.7,-1 0.5,-8.3 3.5,-3.8 0.1,-10.5 2.9,-5.3 0.6,-11.1 2.6,-6.4 4.6,-7.2 4.7,-3.7 3.9,-4.9 -4.9,-1.9 0.6,-16.1 0,0 -10.9,-9.2 -2.9,-5.9 -6.8,2.9 -5.7,-0.9 -3.2,2.3 -5.5,-1.7 -7.5,-11.4 -4,1.5 -7.9,-0.4 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="CG" data-name="Congo" data-id="CG"
                                    data-bs-toggle="tooltip" title="Congo"
                                    d="m 521.5,468.8 -7.9,-0.7 -8.2,-2.4 -7.3,7.4 -6.3,12.8 -0.9,7.5 -9.7,-3.3 -9.9,-3.6 -15.4,-0.6 -0.9,6.1 3.4,7.1 9.1,-1.1 3.1,2.7 -5.3,16.1 5.8,8.2 1.3,10.8 -1.6,9.2 -3.7,6.5 -10.8,-0.6 -6.5,-6.6 -1,6.1 -8.3,1.7 -4.2,3.5 4.6,9.1 -9.3,7.7 9.9,14.6 5,-6 3.7,-2.3 4.6,4.8 3.2,1.4 4.2,-5.3 6.6,0.1 0.8,3.9 4.5,2.5 7.2,-8.7 7.2,-6.8 3.1,-4.4 -0.3,-11.4 5.3,-13.4 5.6,-7.1 8.1,-6.7 1.4,-4.4 0.3,-5.1 2,-4.8 -0.7,-7.8 1.5,-12.3 2.4,-8.6 3.6,-7.4 0.7,-8.4 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="DJ" data-name="Djibouti"
                                    data-id="DJ" data-bs-toggle="tooltip" title="Djibouti"
                                    d="m 820.3,358.7 -5.3,-3.8 6.8,-3.3 0.1,-5.7 -3,-4.3 -3.6,3.4 -5.2,-1.2 -4,6.1 -3.9,6.5 1.1,3.8 0.3,4.2 6.8,0.2 2.9,-0.9 2.8,2.4 4.2,-7.4 z"
                                    style="fill:#f2f2f2 !important" />
                                <path inkscape:connector-curvature="0" id="DZ" data-name="Algeria" data-id="DZ"
                                    data-bs-toggle="tooltip" title="Algeria"
                                    d="M 392.4,5.7 384.6,6.5 379.8,3.3 367.6,3.4 357,8.9 351.2,6.8 332.3,8 l -19.4,2.5 -11,4.3 -7.2,5.8 -12.4,2.4 -11.1,7.7 4.2,9 0.7,8.4 3.9,14.7 3.1,2.9 -2.2,5.4 -15.2,2.3 -5.4,5.1 -6.7,1.2 -0.6,10.2 -13.8,5.4 -4.6,7 -9.6,3.7 -11.8,2.1 -19.2,10.2 -0.2,16.3 0,1 -0.3,2.7 44.1,33.5 40,30.2 40.4,30.2 2.9,6.4 7.5,4 5.5,2.2 0.2,8.8 13.3,-1.3 16.9,-6.2 34.5,-27.1 40.5,-26.4 -5.4,-8.7 -9.6,-6.4 -5.5,2.5 -4.3,-7.7 -0.6,-5.9 -7.2,-10.1 4.6,-5.8 -1.3,-8.7 1.4,-7.6 -1,-6.3 1.8,-11.3 -0.8,-6.4 -4.1,-12.2 -5.7,-24.7 -7.3,-5.6 -0.2,-3.3 -9.7,-8.3 -1.3,-10.4 7,-7.8 2.4,-11.6 -2.3,-13.4 2.2,-7.2 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="EG" data-name="Egypt" data-id="EG"
                                    data-bs-toggle="tooltip" title="Egypt"
                                    d="m 628.8,88.1 -11.9,-4 -11.5,-3.7 -15.6,0.2 -3.7,6.6 2.2,5.9 -2.4,8.5 4.2,11.2 2.9,49.2 2.2,50.9 48.1,0 46.4,0 47.4,0 -2.2,-2.8 -14.7,-12.4 -0.9,-9 2.2,-2.4 -11.6,-15.3 -4.4,-7.9 -4.9,-7.5 -10.5,-21.6 -8.4,-13.9 -6.1,-14.5 1.1,-1.3 10.1,19.8 5.8,6.2 4.3,4.4 2.5,-2.4 2.7,-7.2 1.6,-10.4 2.8,-5.6 -1.5,-3.5 -8.5,-20.1 0,0 -5.4,3.4 -9.2,-0.8 -9.6,-3.2 -2.3,4.5 -3.8,-6.8 -8.5,-1.8 -10.2,1.2 -4.5,3.9 -8.6,4.4 -5.6,-2.2 z"
                                    style="fill:#f2f2f2 !important" />
                                <path inkscape:connector-curvature="0" id="ER" data-name="Eritrea" data-id="ER"
                                    data-bs-toggle="tooltip" title="Eritrea"
                                    d="m 777.6,303.8 -7,-6.8 -4,-12.7 -7.8,-16 -5.7,7.9 -8.8,2.3 -3.6,4.2 -0.7,9.2 -4.3,20.3 1.5,5.6 14.3,2.9 3.3,-10.4 7.6,6.3 7,-3.2 3,2.9 8.3,0.1 10.8,5.6 3.4,4.8 5.5,4.4 5.4,8.1 4.3,4.5 5.2,1.2 3.6,-3.4 -6.2,-4.2 -4,-4.7 -6.9,-8 -7.1,-7.9 -17.1,-13 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="ET" data-name="Ethiopia"
                                    data-id="ET" data-bs-toggle="tooltip" title="Ethiopia"
                                    d="m 754.8,310.3 -3.3,10.4 -14.3,-2.9 -1.4,11.9 -4.5,13.6 -7.1,6.8 -4.8,10.6 -1.1,5.7 -5.6,3.8 -3.3,14.5 0.1,1.7 0.4,10.8 -1.8,4.2 -6.4,0.3 -4,7.9 7.5,1 6.3,6.7 2.2,5.6 5.7,3.2 7.4,15 6.4,2.4 0.1,7.7 4.2,4.6 8.5,0 15.7,11.7 3.8,0.2 2.9,-0.4 2.7,1.6 8.2,1.1 3.5,-5.8 11.1,-5.8 4.9,4.7 8.4,0 3.3,-4.4 7.8,-0.2 10.7,-9.8 15.9,-0.6 33.5,-41.5 -10.3,0.1 -40.3,-16.4 -4.8,-5 -4.6,-6.6 -4.8,-7.7 2.5,-4.9 -2.8,-2.4 -2.9,0.9 -6.8,-0.2 -0.3,-4.2 -1.1,-3.8 3.9,-6.5 4,-6.1 -4.3,-4.5 -5.4,-8.1 -5.5,-4.4 -3.4,-4.8 -10.8,-5.6 -8.3,-0.1 -3,-2.9 -7,3.2 -7.6,-6.3 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="GA" data-name="Gabon" data-id="GA"
                                    data-bs-toggle="tooltip" title="Gabon"
                                    d="m 455.9,485.9 -1.5,-0.7 -7.3,1.8 -7.4,-1.9 -5.8,0.9 0.1,16.7 -17.7,-0.2 -4.2,0.8 -2.4,10.3 -3,10.1 -2.7,4.4 -0.3,4.6 7.3,14.3 8.1,11.4 12.5,14 9.3,-7.7 -4.6,-9.1 4.2,-3.5 8.3,-1.7 1,-6.1 6.5,6.6 10.8,0.6 3.7,-6.5 1.6,-9.2 -1.3,-10.8 -5.8,-8.2 5.3,-16.1 -3.1,-2.7 -9.1,1.1 -3.4,-7.1 0.9,-6.1 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="GH" data-name="Ghana" data-id="GH"
                                    data-bs-toggle="tooltip" title="Ghana"
                                    d="m 296.4,364.9 -5.6,-1.1 -3.9,2.2 -5.4,-1 -21.1,0.6 -0.3,7.9 1.6,10.4 3.2,19.7 -5.1,11.6 -3.2,15.6 5.2,11.9 -0.5,5.5 10.9,3.9 11,-4 6.7,-4.7 19.2,-8.1 -2.8,-4.9 -3.2,-8.8 -1,-6.8 2.7,-12.5 -3,-5 -1.2,-10.9 0,-10.1 -5.1,-7.1 0.9,-4.3 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="GN" data-name="Guinea" data-id="GN"
                                    data-bs-toggle="tooltip" title="Guinea"
                                    d="m 156.4,345.2 -1.8,0.7 -6.6,-1.1 -0.9,1.6 -2.7,0.3 -8.7,-3.4 -5.8,-0.1 -0.3,4.7 -1.3,1.4 0.9,4.6 -1.9,1.8 -2.7,0.1 -3.2,2.3 -3.7,-0.3 -5.5,6.8 3.6,2.2 1.7,3.1 1.3,6.1 3,2.7 3.1,1.8 4.7,5.4 5.3,8.2 6.5,-6.1 1.5,-3.8 2.1,-3 3.3,-0.3 2.9,-2.6 9.7,0 3.3,5 2.6,5.8 -0.4,4 1.9,3.6 -0.1,5.1 3.3,-0.8 2.6,-0.3 3.2,-1.6 5.1,8.5 -0.9,5.6 2.4,2.9 3.4,0.1 2.6,-5.6 3.4,0.4 1.9,0 0.8,-6.1 -0.9,-2.7 1.1,-1.9 4.6,-1.6 -3,-11.1 -2.8,-5.7 1,-4.7 2.5,-1.1 -3.7,-4 0.7,-4.1 -1.6,-1.6 -2.6,1.3 0.6,-4.5 2.5,-3.5 -5,-5.8 -1.4,-3.8 -2.7,-3.1 -2.4,-0.3 -2.9,1.9 -4,1.8 -3.3,3 -5.2,-1.1 -3.3,-3.5 -2,-0.4 -3.2,1.8 -2,0 -0.6,-5 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="GM" data-name="Gambia" data-id="GM"
                                    data-bs-toggle="tooltip" title="Gambia"
                                    d="m 91.9,335.4 11,0.2 3,-1.9 2.2,-0.1 4.5,-3.2 5.2,2.9 5.2,0.3 5.3,-3.1 -2.4,-4 -4,2.3 -3.8,-0.1 -4.7,-3.4 -3.8,0.2 -2.8,3.3 -13.2,0.4 -1.7,6.2 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="GW" data-name="Guinea-Bissau"
                                    data-id="GW" data-bs-toggle="tooltip" title="Guinea-Bissau"
                                    d="m 129.9,343.2 -22.4,-0.6 -3.3,1.6 -4,-0.5 -6.5,2.3 0.7,2.9 3.7,3 -0.1,2.1 2.7,3.9 5.1,0.9 6.4,5.8 5.5,-6.8 3.7,0.3 3.2,-2.3 2.7,-0.1 1.9,-1.8 -0.9,-4.6 1.3,-1.4 0.3,-4.7 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="GQ" data-name="Eq. Guinea"
                                    data-id="GQ" data-bs-toggle="tooltip" title="Eq. Guinea"
                                    d="m 433.9,486 -19.9,-0.3 -4.1,15.5 2.2,2.1 4.2,-0.8 17.7,0.2 -0.1,-16.7 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="KE" data-name="Kenya" data-id="KE"
                                    data-bs-toggle="tooltip" title="Kenya"
                                    d="m 807.2,463.1 -8.4,0 -4.9,-4.7 -11.1,5.8 -3.5,5.8 -8.2,-1.1 -2.7,-1.6 -2.9,0.4 -3.8,-0.2 -15.7,-11.7 -8.5,0 -4.2,-4.6 -0.1,-7.7 -6.4,-2.4 -8.1,9.1 -7.4,8.3 5.9,9.6 1.5,7 5.5,15.8 -4.4,10.1 -5.9,9.2 -3.5,5.6 0,0.7 2.9,5.2 -0.8,10.3 44.1,28.2 0.7,8 17.3,13.8 5,-4.6 2.5,-9.2 4,-5.5 1.9,-9.8 4.6,-1 3.1,-5.8 8.6,-5.5 -7.2,-11.4 -0.4,-50.4 10.5,-15.7 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="LR" data-name="Liberia" data-id="LR"
                                    data-bs-toggle="tooltip" title="Liberia"
                                    d="m 193.3,411 -3.4,-0.4 -2.6,5.6 -3.4,-0.1 -2.4,-2.9 0.9,-5.6 -5.1,-8.5 -3.2,1.6 -2.6,0.3 -5.7,6.5 -5.5,7.5 -0.7,4 -2.9,4.4 8.1,8.9 10.4,7.6 11,10.5 12.6,6.6 3.2,-0.1 1,-11.4 1.1,-1.7 -0.3,-5.5 -5.2,-5.8 -3.8,-0.9 -3.6,-3.8 2.7,-6.1 -1.2,-6.7 0.6,-4 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="LY" data-name="Libya" data-id="LY"
                                    data-bs-toggle="tooltip" title="Libya"
                                    d="m 589.8,80.6 -3.1,-4.5 -11.7,-1.6 -3.9,-2.4 -4.4,0 -4.4,-6.2 -15.9,-2.8 -7.9,1.8 -7.9,6.5 -3.3,6.7 3.4,10.6 -5.3,6.3 -5.5,3.6 L 507,91.7 490.3,86 479.7,83.3 473.6,71 l -15.7,-6.1 -9.8,-2.3 -4.8,1.2 -13.8,-4.8 -0.3,10.6 -5.6,4 -3.4,4.4 -7.9,5.3 1.5,5.7 -0.9,5.8 -5.6,3.2 4.1,12.2 0.8,6.4 -1.8,11.3 1,6.3 -1.4,7.6 1.3,8.7 -4.6,5.8 7.2,10.1 0.6,5.9 4.3,7.7 5.5,-2.5 9.6,6.4 5.4,8.7 19,6 6.9,7.5 8.3,-5.1 11.9,-7.6 48.4,26.5 48.7,26.5 -0.1,-5.8 13.8,0 -1,-27.7 -2.2,-50.9 -2.9,-49.2 -4.2,-11.2 2.4,-8.5 -2.2,-5.9 3.7,-6.6 z"
                                    style="fill:#f2f2f2 !important" />
                                <path inkscape:connector-curvature="0" id="LS" data-name="Lesotho" data-id="LS"
                                    data-bs-toggle="tooltip" title="Lesotho"
                                    d="m 625.3,939.9 2.5,-4.4 6.7,-2.2 2.4,-4.5 4.1,-6.7 -3.8,-4.2 -4.8,-4.2 -5.7,2.8 -6.8,5.4 -6.9,8.7 8,10.6 4.3,-1.3 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="MA" data-name="Morocco" data-id="MA"
                                    data-bs-toggle="tooltip" title="Morocco"
                                    d="m 271.2,30.7 -5,-0.1 -11.9,-3.1 -11,0.9 -6.8,-5.9 -8.5,-0.1 -3.8,8.6 -8,14.5 -8.7,5.7 -11.8,6.4 -7.7,9.3 -1.8,7.3 -4.8,11.8 2.5,17.2 -10.1,11.5 -6,3.7 -9.6,9.4 -11,1.6 -6.1,5.3 -0.2,0.2 -7.9,14.1 -8.1,5.1 -4.5,8.5 -0.5,7.4 -3.4,8.1 -4,2.2 -6.9,8.8 -4.4,9.8 0.7,4.6 -4.1,7.3 -4.7,3.7 -0.8,6.4 0.2,0.1 27,-1.1 1.6,-5 5,-6.2 4.4,-19.1 16.9,-15 6,-17.4 3.7,-1.1 4.2,-10.8 10,-1.4 4.2,1.8 5.4,0 3.9,-3.2 7.3,-0.4 -0.1,-7.5 0,0 1.8,0 0.2,-16.3 19.2,-10.2 11.8,-2.1 9.6,-3.7 4.6,-7 13.8,-5.4 0.6,-10.2 6.7,-1.2 5.4,-5.1 15.2,-2.3 2.2,-5.4 -3.1,-2.9 -3.9,-14.7 -0.7,-8.4 -4.2,-9 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="MG" data-name="Madagascar"
                                    data-id="MG" data-bs-toggle="tooltip" title="Madagascar"
                                    d="m 902.9,704.8 -2.5,-9.1 -3,-5.9 -3.9,-5.9 -4.3,6.2 -0.7,8.3 -7.1,9.6 -5.1,-1.7 1.3,6 -4,6.9 -10.4,8.5 -7.3,7.9 -5.4,0.2 -4.6,2.5 -6.9,2.8 -6,0.6 -2.2,8.7 -4.7,7.8 0.2,12.7 1.7,8.7 2.4,6.6 -1.7,8.8 -6.4,10.5 -0.3,4.6 -5.7,2.4 -2.8,10 0.4,9.9 3.4,11 -0.1,12.3 2.6,7.3 9.1,5 6.5,3.5 10.9,-5.8 9.9,-3.3 6.8,-16.1 6.1,-19.2 9.3,-26.2 7.3,-19.1 5.9,-16.1 1.6,-11.7 3.5,-3.2 1.5,-5.9 -1.7,-10.2 2.6,-4.1 3.5,8.1 2.4,-4.1 1.7,-6.6 -2.8,-6.5 -1,-16.7 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="ML" data-name="Mali" data-id="ML"
                                    data-bs-toggle="tooltip" title="Mali"
                                    d="m 347.4,252.3 -13.3,1.3 -0.2,-8.8 -5.5,-2.2 -7.5,-4 -2.9,-6.4 -40.4,-30.2 -40,-30.2 -18.2,0.2 5.1,59.7 5.4,59.7 2,1.8 -2.7,9.6 -48.5,0.2 -1.9,3.1 -4.6,-0.9 -6.9,2.7 -8.4,-3.8 -3.8,0.3 -2.2,8.2 -4.1,2.5 0.4,8.6 2.3,7.9 4.5,3.9 1,5.3 -0.6,4.4 0.6,5 2,0 3.2,-1.8 2,0.4 3.3,3.5 5.2,1.1 3.3,-3 4,-1.8 2.9,-1.9 2.4,0.3 2.7,3.1 1.4,3.8 5,5.8 -2.5,3.5 -0.6,4.5 2.6,-1.3 1.6,1.6 -0.7,4.1 3.7,4 1.6,-1.3 3.3,2.1 9.4,0.1 2.3,-4 2.1,0.3 3.5,-1.6 1.8,5.9 2.9,-1.7 5,-2.1 -0.8,-8 3.4,-5.9 -0.3,-4.7 9.7,-11.4 1.8,-9.5 3.4,-3.4 5.8,1.9 5.1,-2.8 1.7,-3.6 9.4,-6.2 2.3,-4.3 11.3,-5.8 6.7,-1.9 3,2.6 7.8,0 7.7,-0.6 4.5,-4.9 16.5,-1.2 10.7,-2.2 1,-8.5 6.6,-9.2 -0.3,-31.9 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="MZ" data-name="Mozambique"
                                    data-id="MZ" data-bs-toggle="tooltip" title="Mozambique"
                                    d="m 788.2,666.2 -1.7,-6.2 0,0 0,0 -10,8.1 -13.4,5.3 -7.3,-0.2 -4.5,4.2 -8.4,0.3 -3.3,1.8 -14.4,-3.9 -4.7,0.5 -3.3,13.1 1.4,15.8 0.7,0 4.2,4.4 4.6,10 0.3,17.8 -5.4,3 -4.1,9.6 -7.5,-8.6 -0.5,-9.7 2.9,-6.5 -0.5,-5.5 -4.7,-3.5 -3.3,1.2 -6.8,-6.6 -37.1,11.4 0.8,9.9 0.6,5.1 10,-0.3 5.5,3 2.5,3.4 5.7,1 6.1,4.4 -0.8,17.5 -2.8,9.6 -1,10.4 1.7,4.1 -1.7,8.1 -1.9,1.3 -3.6,9.9 -13.4,15.7 4.7,19.5 2.5,9.9 -3,15.4 0.7,5 1.3,6.2 0.6,6.1 9,0.1 1.5,-7.3 -2.9,-0.9 -0.6,-5.8 5.5,-5.2 14.8,-7.5 10.1,-4.6 5.3,-5 2.1,-5.7 -2.7,-2.4 2.4,-6.4 1.1,-13.6 -2.2,0.7 0.1,-4.1 -1.9,-8.1 -5.2,-10.5 1.6,-9.9 5.1,-3.2 8.9,-9.8 4.7,-2.5 14.4,-14.9 14,-6.7 11.3,-5.3 8.1,-8.5 5.2,-9.6 4.1,-9.9 -1.8,-6.8 0.4,-21.6 -1,-12.2 0.9,-13.8 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="MR" data-name="Mauritania"
                                    data-id="MR" data-bs-toggle="tooltip" title="Mauritania"
                                    d="m 237.6,171.8 -44.1,-33.5 -0.5,20.9 -38.9,-0.7 -0.4,35.4 -11.2,1.3 -3.1,7.1 1.9,20 -46.9,-0.1 -2.7,4.6 6.1,6 3,6.5 -1.4,6.9 1.3,6.9 1,13.7 -1.8,13 -3.5,6.8 0.9,7.5 4.2,-4.5 6,1.2 5.9,-3 6.8,-0.1 5.7,4 7.9,3.7 7.2,10.2 7.8,9.5 4.1,-2.5 2.2,-8.2 3.8,-0.3 8.4,3.8 6.9,-2.7 4.6,0.9 1.9,-3.1 48.5,-0.2 2.7,-9.6 -2,-1.8 -5.4,-59.7 -5.1,-59.7 18.2,-0.2 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="MW" data-name="Malawi" data-id="MW"
                                    data-bs-toggle="tooltip" title="Malawi"
                                    d="m 714.6,711.7 0.3,-5.2 -2.7,-4.1 0.4,-6 -3.3,-10.2 3.7,-7.7 -0.2,-16.7 -4.1,-8.9 0.4,-1.5 0,0 -2.3,-3.8 -11.9,-2.6 5.6,6.2 2.8,11.7 -2.2,3.8 -2.7,11.2 2,11.5 -4,4.8 -4.1,12.8 6.2,3.6 6.8,6.6 3.3,-1.2 4.7,3.5 0.5,5.5 -2.9,6.5 0.5,9.7 7.5,8.6 4.1,-9.6 5.4,-3 -0.3,-17.8 -4.6,-10 -4.2,-4.4 -0.7,0 0.1,1.9 2.3,0.5 2.2,7.4 -0.4,1.7 -4.1,-5.3 -2.2,3.4 -1.9,-2.9 z"
                                    style="fill:#f2f2f2" />

                                <path inkscape:connector-curvature="0" id="NA" data-name="Namibia" data-id="NA"
                                    data-bs-toggle="tooltip" title="Namibia"
                                    d="m 576,759.7 -22.4,5.7 -29.1,-2 -8.2,-6.6 -48.8,0.6 -1.9,1 -7.1,-6.3 -7.8,-0.4 -7.2,2.3 -5.9,2.7 0.6,10.6 9.5,13.5 2.5,8.7 6,16.6 5.9,11.4 4.6,5.7 1.3,7.6 -0.1,16.5 3.4,21.3 2.6,10.1 2.2,13.4 4.3,10.1 8.3,10.5 6,-6.8 4.5,3.7 1.7,6 5.2,1 7.3,2.6 6.4,-1 10.8,-7.1 2.2,-51.1 1.4,-40.4 11.8,-0.5 1.9,-49.3 9,-0.4 18.7,-4.9 4.4,5.7 7.9,-5.4 3.6,0 6.9,-3.1 0,-1.2 -4.7,-3.1 -7.8,-0.8 -9.9,3.1 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="NE" data-name="Niger" data-id="NE"
                                    data-bs-toggle="tooltip" title="Niger"
                                    d="m 458.3,198.6 -19,-6 -40.5,26.4 -34.5,27.1 -16.9,6.2 0.3,31.9 -6.6,9.2 -1,8.5 -10.7,2.2 -16.5,1.2 -4.5,4.9 -7.7,0.6 -1,6.7 1.6,6.3 6.9,9 0.4,6.7 14,3.1 -0.3,9.5 4.1,-4 4.3,-0.1 9.3,8 0.8,-12.4 3.5,-5.5 1.6,-8 3.2,-3 13,-1.6 12.2,5.1 4.6,5.3 6.1,0.2 5.8,-3.4 14.7,7.1 6.2,-0.3 7.1,-5.9 7.1,0.4 3.5,-1.9 6.5,0.8 9.4,4 9.4,-7.7 2.9,0.6 8.4,15.1 2.2,-0.3 0.4,-4.4 3.4,-0.8 1.1,-6.5 -7.8,-0.3 -0.1,-8.9 -5.1,-5.2 4.9,-18.2 15.2,-13 0.2,-18 4,-28.1 2.5,-6 -5.1,-4.7 -0.3,-4.4 -4.6,-3.6 -3.4,-21.5 -8.3,5.1 -6.9,-7.5 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="NG" data-name="Nigeria" data-id="NG"
                                    data-bs-toggle="tooltip" title="Nigeria"
                                    d="m 468.2,344.6 -2.2,0.3 -8.4,-15.1 -2.9,-0.6 -9.4,7.7 -9.4,-4 -6.5,-0.8 -3.5,1.9 -7.1,-0.4 -7.1,5.9 -6.2,0.3 -14.7,-7.1 -5.8,3.4 -6.1,-0.2 -4.6,-5.3 -12.2,-5.1 -13,1.6 -3.2,3 -1.6,8 -3.5,5.5 -0.8,12.4 -0.5,4.6 2.8,8.2 -2.4,5.6 1.3,3.7 -5.9,8.5 -3.7,4.3 -2.3,8.7 0.3,8.8 -0.6,22.3 10.7,0 9.2,-0.1 8.6,9.1 4.1,10 6.5,8.6 9.8,0.3 4.7,-3.1 4.6,0.8 12.7,-5 3.1,-9.8 5.7,-13.4 3.6,-0.1 7.2,-8.1 4.6,-0.2 6.9,5.7 8.3,-4.7 1.1,-5.7 2.7,-5.6 1.9,-7 6.4,-5.7 2.4,-9.7 2.6,-3.1 1.6,-7.2 3.1,-8.8 10.2,-10.7 0.5,-4.6 1.3,-2.5 -4.9,-5.5 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="RW" data-name="Rwanda" data-id="RW"
                                    data-bs-toggle="tooltip" title="Rwanda"
                                    d="m 667.9,533 -7.4,4.3 -2.9,-1.4 -3.5,3.8 -0.5,8.3 -1.7,1 -1.2,7.6 7.4,1.1 3.8,-7.9 6.5,0.9 0,0 3.5,-1.8 0.8,-8.1 -4.8,-7.8 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="EH" data-name="W. Sahara"
                                    data-id="EH" data-bs-toggle="tooltip" title="W. Sahara"
                                    d="m 193.8,134.6 -1.8,0 0,0 0.1,7.5 -7.3,0.4 -3.9,3.2 -5.4,0 -4.2,-1.8 -10,1.4 -4.2,10.8 -3.7,1.1 -6,17.4 -16.9,15 -4.4,19.1 -5,6.2 -1.6,5 -27,1.1 -0.2,-0.1 -0.6,5.9 2.7,-4.6 46.9,0.1 -1.9,-20 3.1,-7.1 11.2,-1.3 0.4,-35.4 38.9,0.7 0.5,-20.9 0.3,-2.7 0,-1 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="SD" data-name="Sudan" data-id="SD"
                                    data-bs-toggle="tooltip" title="Sudan"
                                    d="m 740,291.9 0.7,-9.2 3.6,-4.2 8.8,-2.3 5.7,-7.9 -6.9,-5.1 -4.8,-3.4 -5.3,-16.5 -2.5,-14.3 2.5,-2.5 -4.7,-13.6 -47.4,0 -46.4,0 -48.1,0 1,27.7 -13.8,0 0.1,5.8 2.4,54.9 -10.5,-0.9 -5.2,10.2 -3,8.5 2.6,3.2 -3.8,4.3 1.5,5.7 -3,5.8 -1.2,5 4.3,-0.8 2.6,5.4 0.3,8 4.6,4.1 -0.1,3.4 1.5,5.9 7.2,8.6 0.1,5.7 -1.9,5.7 0.9,4.3 4.2,4 1,0.7 3.8,-1.6 4.1,-2.6 2.9,-12.3 3.2,-6.4 8.8,-1.9 2.1,3.8 6.5,8 3.3,1.2 4.4,-2.3 8.7,0.4 1.8,2.9 12.1,0 0.3,-2.9 6.3,-2.6 1.1,-4 4.6,-2.9 10.4,8.1 6.2,-1.4 5.8,-10 6.5,-7.6 -1.3,-8.3 -3,-4 7.3,-0.8 0.7,-3 5.7,0.9 -1.2,10.2 1.7,10 6.5,5.5 1.5,4.7 0,6.9 1.7,0.3 -0.1,-1.7 3.3,-14.5 5.6,-3.8 1.1,-5.7 4.8,-10.6 7.1,-6.8 4.5,-13.6 1.4,-11.9 -1.5,-5.6 4.3,-20.3 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="SS" data-name="S. Sudan"
                                    data-id="SS" data-bs-toggle="tooltip" title="S. Sudan"
                                    d="m 707.8,379.2 -1.5,-4.7 -6.5,-5.5 -1.7,-10 1.2,-10.2 -5.7,-0.9 -0.7,3 -7.3,0.8 3,4 1.3,8.3 -6.5,7.6 -5.8,10 -6.2,1.4 -10.4,-8.1 -4.6,2.9 -1.1,4 -6.3,2.6 -0.3,2.9 -12.1,0 -1.8,-2.9 -8.7,-0.4 -4.4,2.3 -3.3,-1.2 -6.5,-8 -2.1,-3.8 -8.8,1.9 -3.2,6.4 -2.9,12.3 -4.1,2.6 -3.8,1.6 8.4,5.4 6.8,5.5 0.1,4.5 8.3,7.2 5.2,6 3.2,8.3 9.2,5.5 2,4.4 7.5,11.4 5.5,1.7 3.2,-2.3 5.7,0.9 6.8,-2.9 2.9,5.9 10.9,9.2 0,0 5,-3.8 7.8,3.1 9.8,-3.3 8.6,0.1 7.4,-6.4 7.4,-8.3 8.1,-9.1 -7.4,-15 -5.7,-3.2 -2.2,-5.6 -6.3,-6.7 -7.5,-1 4,-7.9 6.4,-0.3 1.8,-4.2 -0.4,-10.8 -1.7,-0.3 0,-6.9 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="SN" data-name="Senegal" data-id="SN"
                                    data-bs-toggle="tooltip" title="Senegal"
                                    d="m 148.8,315.1 -7.8,-9.5 -7.2,-10.2 -7.9,-3.7 -5.7,-4 -6.8,0.1 -5.9,3 -6,-1.2 -4.2,4.5 -3,7.1 -6.1,9.7 -5.4,2.6 6,4.9 4.8,10.8 13.2,-0.4 2.8,-3.3 3.8,-0.2 4.7,3.4 3.8,0.1 4,-2.3 2.4,4 -5.3,3.1 -5.2,-0.3 -5.2,-2.9 -4.5,3.2 -2.2,0.1 -3,1.9 -11,-0.2 1.8,10.6 6.5,-2.3 4,0.5 3.3,-1.6 22.4,0.6 5.8,0.1 8.7,3.4 2.7,-0.3 0.9,-1.6 6.6,1.1 1.8,-0.7 0.6,-4.4 -1,-5.3 -4.5,-3.9 -2.3,-7.9 -0.4,-8.6 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="SL" data-name="Sierra Leone"
                                    data-id="SL" data-bs-toggle="tooltip" title="Sierra Leone"
                                    d="m 171.5,401 -3.3,0.8 0.1,-5.1 -1.9,-3.6 0.4,-4 -2.6,-5.8 -3.3,-5 -9.7,0 -2.9,2.6 -3.3,0.3 -2.1,3 -1.5,3.8 -6.5,6.1 1.4,10.3 2.1,5 6.3,7.4 8.7,5.6 3.3,1 2.9,-4.4 0.7,-4 5.5,-7.5 5.7,-6.5 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="SZ" data-name="Swaziland"
                                    data-id="SZ" data-bs-toggle="tooltip" title="Swaziland"
                                    d="m 674,874.9 -5.8,-2.6 -3.5,1 -1.4,4 -3.6,5.2 -0.2,4.8 6.6,7.5 7,-1.5 2.8,-6.1 -0.6,-6.1 -1.3,-6.2 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="TD" data-name="Chad" data-id="TD"
                                    data-bs-toggle="tooltip" title="Chad"
                                    d="m 582.5,246.4 -48.7,-26.5 -48.4,-26.5 -11.9,7.6 3.4,21.5 4.6,3.6 0.3,4.4 5.1,4.7 -2.5,6 -4,28.1 -0.2,18 -15.2,13 -4.9,18.2 5.1,5.2 0.1,8.9 7.8,0.3 -1.1,6.5 4.9,8.9 1,9.1 -0.4,9.2 6.8,12.6 -6.8,-0.1 -3.4,0.9 -5.6,-1.3 -2.5,6.5 7.2,8.1 5.3,2.3 1.8,5.7 3.9,9.6 -1.8,3.7 10,-1 2.2,-3.6 2.1,0.3 3,3.1 15.3,-5.3 5.1,-5.4 6.3,-4.8 -1.2,-4.9 3.4,-1.2 11.8,0.8 11.3,-6.4 8.6,-15.1 6,-5.6 7.7,-2.3 0.1,-3.4 -4.6,-4.1 -0.3,-8 -2.6,-5.4 -4.3,0.8 1.2,-5 3,-5.8 -1.5,-5.7 3.8,-4.3 -2.6,-3.2 3,-8.5 5.2,-10.2 10.5,0.9 -2.4,-54.9 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="TG" data-name="Togo" data-id="TG"
                                    data-bs-toggle="tooltip" title="Togo"
                                    d="m 307.1,365.2 -10.7,-0.3 -0.9,4.3 5.1,7.1 0,10.1 1.2,10.9 3,5 -2.7,12.5 1,6.8 3.2,8.8 2.8,4.9 9.8,-3 -3,-9.5 0.5,-31.8 -2.5,-2.8 -0.4,-6.8 -4.3,-4.9 -3.7,-4.1 1.6,-7.2 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="TN" data-name="Tunisia" data-id="TN"
                                    data-bs-toggle="tooltip" title="Tunisia"
                                    d="m 429.5,59 -4.5,-2.2 -3.2,-6.6 -6,-0.2 -2.4,-7.6 7.3,-7 1.1,-12.1 -4.1,-3.5 -0.2,-6.5 5.5,-7 -0.9,-2.7 -9.5,5.2 0.1,-7.1 -8.1,-1.7 -12.2,5.7 -2.2,7.2 2.3,13.4 -2.4,11.6 -7,7.8 1.3,10.4 9.7,8.3 0.2,3.3 7.3,5.6 5.7,24.7 5.6,-3.2 0.9,-5.8 -1.5,-5.7 7.9,-5.3 3.4,-4.4 5.6,-4 0.3,-10.6 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="TZ" data-name="Tanzania"
                                    data-id="TZ" data-bs-toggle="tooltip" title="Tanzania"
                                    d="m 672.2,531.3 -4.3,1.7 4.8,7.8 -0.8,8.1 -3.5,1.8 0,0 0.6,5.4 2.6,3.2 0.1,4.5 -3,2.9 -4.9,7.2 -4.5,5 -1.2,0.2 -0.7,5.9 2.3,2 -0.5,5.9 2.3,5.5 -2.9,5.3 9.7,9.4 0.8,8.5 5.9,14.2 0,0 0.6,0.4 4.8,2.3 7.7,2.4 6.8,4.1 11.9,2.6 2.3,3.8 0,0 0.8,-2.7 6.2,7.4 0.6,14.5 3.9,5.3 -0.1,0.2 4.7,-0.5 14.4,3.9 3.3,-1.8 8.4,-0.3 4.5,-4.2 7.3,0.2 13.4,-5.3 10,-8.1 0,0 -4.4,-3 -4.7,-13.6 -4,-8.7 1,-6.6 -0.6,-4.2 3.5,-8.4 -0.3,-3.6 -7.7,-5 -0.6,-7.8 5.9,-17.1 -17.3,-13.8 -0.7,-8 -44.1,-28.2 0,0 -6,6.1 -4.1,6.3 4.8,4.7 -7,3.4 -1.5,-1.6 -7.1,0.9 -5.5,3.1 -3.3,-5.4 2.3,-9.7 0.5,-8.3 0,0 0,0 -13.4,-0.2 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="UG" data-name="Uganda" data-id="UG"
                                    data-bs-toggle="tooltip" title="Uganda"
                                    d="m 711.3,458.5 -7.4,6.4 -8.6,-0.1 -9.8,3.3 -7.8,-3.1 -5,3.8 0,0 -0.6,16.1 4.9,1.9 -3.9,4.9 -4.7,3.7 -4.6,7.2 -2.6,6.4 -0.6,11.1 -2.9,5.3 -0.1,10.5 2.9,1.4 7.4,-4.3 4.3,-1.7 13.4,0.2 0,0 -0.7,-5.3 5.7,-8.1 7.7,-2 5.2,-3.3 6.3,2.7 0.6,1 0,-0.7 3.5,-5.6 5.9,-9.2 4.4,-10.1 -5.5,-15.8 -1.5,-7 -5.9,-9.6 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="ZA" data-name="South Africa"
                                    data-id="ZA" data-bs-toggle="tooltip" title="South Africa"
                                    d="m 522.3,999 5.3,-0.3 7.5,-5.3 10,-2.2 12.3,-5.5 4.7,0.7 7.2,-1.7 12.3,2.7 5.9,-2.6 6.9,2 1.8,-3.8 6,-0.8 12.6,-5.3 9.3,-6.3 8.9,-8.3 14.4,-14.2 7.5,-9.9 3.9,-7.1 5.5,-7 2.5,-2 8.6,-7 3.5,-6.2 2.3,-11.5 3.7,-10.1 -9,-0.1 -2.8,6.1 -7,1.5 -6.6,-7.5 0.2,-4.8 3.6,-5.2 1.4,-4 3.5,-1 5.8,2.6 -0.7,-5 3,-15.4 -2.5,-9.9 -4.7,-19.5 -6.3,-1.3 -4.1,1.6 -5.7,-2.3 -4.9,-0.2 -17.3,10.2 -11.2,10.3 -4.4,9.3 -3.9,5.2 -6.5,1.1 -2.4,6.6 -1.4,4.3 -7.8,3.2 -9.6,-0.6 -5.5,-3.9 -4.9,-1.7 -6,3.2 -3.2,6.6 -5.8,4.2 -6.2,6.2 -8.5,1.4 -2.5,-4.9 1.5,-8.4 -6.5,-13.2 -3.2,-2 -2.2,51.1 -10.8,7.1 -6.4,1 -7.3,-2.6 -5.2,-1 -1.7,-6 -4.5,-3.7 -6,6.8 7.7,17.9 0,0.1 5.4,11.7 6.9,12.8 -0.2,10.6 -3.9,2.5 3.2,9.3 -0.5,8.1 1.3,3.8 0.7,-1.9 4.6,6.2 3.8,0.2 4.6,5 z m 103,-59.1 -4.3,1.3 -8,-10.6 6.9,-8.7 6.8,-5.4 5.7,-2.8 4.8,4.2 3.8,4.2 -4.1,6.7 -2.4,4.5 -6.7,2.2 -2.5,4.4 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="ZM" data-name="Zambia" data-id="ZM"
                                    data-bs-toggle="tooltip" title="Zambia"
                                    d="m 671.3,636 -4.1,-1.1 0.7,-3 -2.1,-0.6 -16.4,2.3 -3.3,1.7 -3.6,8.8 2.6,6.1 -2.5,16.4 -1.9,13.9 3.2,2.4 8.4,5.4 3.4,-2.5 0.6,14.9 -9.3,-0.1 -4.8,-7.6 -4.3,-5.9 -9.2,-1.9 -2.6,-7.3 -7.5,4.4 -9.7,-2 -3.9,-6.2 -7.7,-1.3 -5.7,0.3 -0.6,-4.3 -4.2,-0.3 1.2,4.3 -1.5,6.7 2,6.5 -2,5.2 1,4.7 -25.3,-0.1 -1.6,44 7.8,11.3 7.6,8.6 9.9,-3.1 7.8,0.8 4.7,3.1 0,1.2 2.2,1 13.4,1.5 3.8,1.6 4.1,-0.3 7,-9 10.9,-11.4 4.4,-1 1.7,-4.8 7,-5.5 9.3,-1.9 -0.8,-9.9 37.1,-11.4 -6.2,-3.6 4.1,-12.8 4,-4.8 -2,-11.5 2.7,-11.2 2.2,-3.8 -2.8,-11.7 -5.6,-6.2 -6.8,-4.1 -7.7,-2.4 -4.8,-2.3 -0.6,-0.4 0,0 0.9,2.3 -2,0.8 -2.6,-2.9 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="ZW" data-name="Zimbabwe"
                                    data-id="ZW" data-bs-toggle="tooltip" title="Zimbabwe"
                                    d="m 669.1,825.1 13.4,-15.7 3.6,-9.9 1.9,-1.3 1.7,-8.1 -1.7,-4.1 1,-10.4 2.8,-9.6 0.8,-17.5 -6.1,-4.4 -5.7,-1 -2.5,-3.4 -5.5,-3 -10,0.3 -0.6,-5.1 -9.3,1.9 -7,5.5 -1.7,4.8 -4.4,1 -10.9,11.4 -7,9 -4.1,0.3 -3.8,-1.6 -13.4,-1.5 4.2,11.1 2.3,2.4 3.5,8 13,15.2 5.1,1.5 -0.2,4.9 3.1,8.8 9.2,2.1 7.3,6.2 4.9,0.2 5.7,2.3 4.1,-1.6 6.3,1.3 z"
                                    style="fill:#f2f2f2" />
                                <path inkscape:connector-curvature="0" id="SO" data-name="Somalia" data-id="SO"
                                    data-bs-toggle="tooltip" title="Somalia"
                                    d="m 832.6,372.8 -5.7,-5.8 -2.5,-5.7 -4.1,-2.6 -4.2,7.4 -2.5,4.9 4.8,7.7 4.6,6.6 4.8,5 40.3,16.4 10.3,-0.1 -33.5,41.5 -15.9,0.6 -10.7,9.8 -7.8,0.2 -3.3,4.4 -10.5,15.7 0.4,50.4 7.2,11.4 2.7,-3.3 2.9,-7.3 13.4,-16.7 11.4,-10.6 18.1,-13.7 12.1,-11.2 14.1,-18.9 10.1,-15.5 10,-20.2 7,-17.7 5.4,-15.5 2.9,-14.9 2.4,-5 -0.4,-7.3 0.8,-8 -0.5,-3.9 -4.6,0.1 -5.5,4.7 -6.4,1.4 -5.5,2.1 -3.9,0.2 0,0 -6.9,0.5 -4.2,2.6 -6,0.9 -10.5,4.3 -13.2,1.6 -11.3,3.5 -6.1,0 z"
                                    style="fill:#f2f2f2 !important" />

                            </svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Country Modal -->
    <div id="countryModal" class="modal fade" tabindex="-1" style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="countryModalTitle">Informations sur le pays</h5>
                    <button type="button" class="btn-close" onclick="closeCountryModal()"></button>
                </div>
                <div class="modal-body" id="countryModalBody">
                    <div class="text-center py-4">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Chargement...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- temoignages -->
    <section class="temoignages">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h2>{{ $pageContent['testimonials_section_title'] ?? 'Études de cas/témoignages' }}</h2>
            </div>

            <div class="swiper temoignages-swiper wow fadeInRight">
                <div class="swiper-wrapper">
                    @foreach ($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="cardBlog">
                                <a href="{{ $testimonial->activities_testimonial_link ?? '#' }}">
                                    <div class="cardBlog--img">
                                        <img src="{{ asset($testimonial->activities_testimonial_image ?? 'img/21.jpg') }}"
                                            alt="{{ $testimonial->activities_testimonial_title }}">
                                    </div>

                                    <div class="cardBlog--body">
                                        <h3>{{ $testimonial->activities_testimonial_title }}</h3>
                                        <p>{{ Str::limit($testimonial->activities_testimonial_description, 200) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($testimonials->count() > 1)
                    <div class="navigation-buttons-swiper">
                        <div class="swiper-button-prev temoignages-prev"></div>
                        <div class="swiper-button-next temoignages-next"></div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function scrollToSection() {
            document.getElementById('next-section').scrollIntoView({
                behavior: 'smooth'
            });
        }

        // Interactive Map functionality
        document.addEventListener('DOMContentLoaded', function() {
            const svgPaths = document.querySelectorAll('#map svg path[data-id]');
            
            // Data from backend
            const activeCountries = @json($countries->map(function($country) {
                return [
                    'code' => $country->country_code,
                    'color' => $country->color ?? '#FFD700',
                    'name' => $country->country_name
                ];
            }));

            // Create a map of country codes to colors for easy lookup
            const countryColors = {};
            activeCountries.forEach(country => {
                countryColors[country.code] = country.color;
            });

            // Initialize map colors
            svgPaths.forEach(path => {
                const countryCode = path.getAttribute('data-id') || path.getAttribute('id');
                
                // Apply color if country is active
                if (countryColors[countryCode]) {
                    path.style.fill = countryColors[countryCode];
                    path.setAttribute('data-original-color', countryColors[countryCode]);
                    path.style.cursor = 'pointer';
                } else {
                    // Default styling for inactive countries
                    path.setAttribute('data-original-color', '#f2f2f2');
                }
                
                path.style.transition = 'all 0.3s ease';

                path.addEventListener('mouseenter', function() {
                    // Only apply hover effect if country is active (has a color in our list)
                    if (countryColors[countryCode]) {
                        this.style.fill = '#D4A017'; // Hover color (darker gold)
                        this.style.opacity = '0.8';
                    }
                });

                path.addEventListener('mouseleave', function() {
                    // Restore original color
                    const originalColor = this.getAttribute('data-original-color');
                    this.style.fill = originalColor;
                    this.style.opacity = '1';
                });

                // Add click event to show country modal
                path.addEventListener('click', function() {
                    // Only show modal for active countries
                    if (countryColors[countryCode]) {
                        const countryName = this.getAttribute('data-name') || this.getAttribute('data-bs-title');
                        showCountryInfo(countryCode, countryName);
                    }
                });
            });
        });

        function showCountryInfo(countryCode, countryName) {
            const modal = document.getElementById('countryModal');
            const modalTitle = document.getElementById('countryModalTitle');
            const modalBody = document.getElementById('countryModalBody');

            // Show modal with loading state
            modal.style.display = 'block';
            modal.classList.add('show');
            document.body.classList.add('modal-open');

            // Create backdrop
            const backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade show';
            backdrop.id = 'countryModalBackdrop';
            document.body.appendChild(backdrop);

            // Set title
            modalTitle.textContent = countryName || 'Informations sur le pays';

            // Show loading spinner
            modalBody.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Chargement...</span>
                    </div>
                </div>
            `;

            // Fetch country data
            fetch(`/activities/country/${countryCode}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Pays non trouvé');
                    }
                    return response.json();
                })
                .then(country => {
                    displayCountryInfo(country);
                })
                .catch(error => {
                    modalBody.innerHTML = `
                        <div class="alert alert-warning">
                            <p class="mb-0">Aucune information disponible pour ce pays.</p>
                        </div>
                    `;
                });
        }

        function displayCountryInfo(country) {
            const modalBody = document.getElementById('countryModalBody');

            let activitiesList = '';
            if (country.activities && country.activities.length > 0) {
                activitiesList = '<ul class="list-unstyled">';
                country.activities.forEach(activity => {
                    activitiesList += `<li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>${activity}</li>`;
                });
                activitiesList += '</ul>';
            } else {
                activitiesList = '<p class="text-muted">Aucune activité enregistrée.</p>';
            }

            let imageHtml = '';
            if (country.image) {
                imageHtml = `
                    <div class="mb-4">
                        <img src="{{ asset('') }}${country.image}" alt="${country.country_name}" class="img-fluid rounded" style="max-height: 300px; width: 100%; object-fit: cover;">
                    </div>
                `;
            }

            let descriptionHtml = '';
            if (country.description) {
                descriptionHtml = `
                    <div class="mb-4">
                        <h6 class="fw-bold">Description</h6>
                        <p>${country.description}</p>
                    </div>
                `;
            }

            modalBody.innerHTML = `
                ${imageHtml}
                ${descriptionHtml}
                <div>
                    <h6 class="fw-bold">Nos activités en ${country.country_name}</h6>
                    ${activitiesList}
                </div>
            `;
        }

        function closeCountryModal() {
            const modal = document.getElementById('countryModal');
            const backdrop = document.getElementById('countryModalBackdrop');

            modal.style.display = 'none';
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');

            if (backdrop) {
                backdrop.remove();
            }
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('countryModal');
            if (event.target === modal) {
                closeCountryModal();
            }
        });
    </script>

    <style>
        /* Modal styles */
        #countryModal {
            background-color: rgba(0, 0, 0, 0.5);
        }

        #countryModal.show {
            display: block !important;
        }

        /* Map interaction styles */
        #map svg path[data-id] {
            transition: all 0.3s ease;
        }
    </style>
@endsection
