<!-- footer -->
<footer class="">
    <div class="container-lg">
        @php
            // Récupération directe des données du footer
            $footerSettings = \App\Models\FooterSetting::first();
            $footerColumns = \App\Models\FooterColumn::with('activeLinks')->active()->orderBy('column_order')->get();
            $footerSocials = \App\Models\FooterSocial::active()->get();
        @endphp

        <div class="row footer-top align-items-start text-md-start wow fadeInUp">
            <div class="col-12 col-lg-3 footer-logo mb-4 mb-md-0">
                @if($footerSettings && $footerSettings->footer_logo1)
                    <a href="#" class="logo-footer-1">
                        <img src="{{ asset($footerSettings->footer_logo1) }}" alt="Kenaya Impact">
                    </a>
                @else
                    <a href="#" class="logo-footer-1">
                        <img src="{{ asset('img/Logo.png') }}" alt="Kenaya Impact">
                    </a>
                @endif

                @if($footerSettings && $footerSettings->footer_logo2)
                    <a href="#" class="logo-footer-2">
                        <img src="{{ asset($footerSettings->footer_logo2) }}" alt="Kenaya Impact">
                    </a>
                @else
                    <a href="#" class="logo-footer-2">
                        <img src="{{ asset('img/Logo.png') }}" alt="Kenaya Impact">
                    </a>
                @endif
            </div>

            @if($footerColumns->count() > 0)
                @foreach($footerColumns as $column)
                    <div class="col-12 col-lg-3 footer-column">
                        <div class="footer-title">{{ $column->column_title }}</div>
                        <div class="footer-links">
                            @foreach($column->activeLinks as $link)
                                <a href="{{ $link->link_url }}">{{ $link->link_text }}</a>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Fallback si pas de colonnes en base de données -->
                <div class="col-12 col-lg-3 footer-column">
                    <div class="footer-title">{{ __('footer.about_company') }}</div>
                    <div class="footer-links">
                        <a href="#">{{ __('footer.company_history') }}</a>
                        <a href="#">{{ __('footer.mission_vision_values') }}</a>
                        <a href="#">{{ __('footer.transition') }}</a>
                        <a href="#">{{ __('footer.leadership_team') }}</a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 footer-column">
                    <div class="footer-title">{{ __('footer.our_activities') }}</div>
                    <div class="footer-links">
                        <a href="#">{{ __('footer.intervention_areas') }}</a>
                        <a href="#">{{ __('footer.services_offered') }}</a>
                        <a href="#">{{ __('footer.geographic_coverage') }}</a>
                        <a href="#">{{ __('footer.case_studies') }}</a>
                    </div>
                </div>
                <div class="col-12 col-lg-3 footer-column">
                    <div class="footer-title">{{ __('news.title') }}</div>
                    <div class="footer-links">
                        <a href="#">{{ __('news.blog') }}</a>
                        <a href="#">{{ __('news.events') }}</a>
                        <a href="#">{{ __('news.publications') }}</a>
                        <a href="#">{{ __('news.press_releases') }}</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="row py-5">
            <div class="col text-center wow fadeInUp">
                <p class="mb-3">{{ __('footer.follow_us') }}</p>
                <div class="footer-social">
                    @if($footerSocials->count() > 0)
                        @foreach($footerSocials as $social)
                            <a href="{{ $social->social_url }}" target="_blank">
                                <img src="{{ asset($social->social_icon) }}" alt="{{ $social->social_platform }}">
                            </a>
                        @endforeach
                    @else
                        <!-- Fallback réseaux sociaux -->
                        <a href="#"><img src="{{ asset('img/1.png') }}" alt="Facebook"></a>
                        <a href="#"><img src="{{ asset('img/2.png') }}" alt="X"></a>
                        <a href="#"><img src="{{ asset('img/3.png') }}" alt="Instagram"></a>
                        <a href="#"><img src="{{ asset('img/4.png') }}" alt="YouTube"></a>
                        <a href="#"><img src="{{ asset('img/5.png') }}" alt="LinkedIn"></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom wow fadeInUp">
        <div>&copy;{{ $footerSettings ? $footerSettings->footer_copyright : 'KENAYAIMPACT 2025' }}</div>
        <a href="{{ $footerSettings ? $footerSettings->footer_legal_link : '#' }}">
            {{ $footerSettings ? $footerSettings->footer_legal_text : __('footer.legal_notice') }}
        </a>
    </div>
</footer>
