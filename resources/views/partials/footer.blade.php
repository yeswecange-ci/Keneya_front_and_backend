<!-- footer -->
<footer class="mt-5">
    <div class="container-lg">
        <div class="row footer-top align-items-start text-md-start wow fadeInUp">
            <div class="col-12 col-lg-3 footer-logo mb-4 mb-md-0">
                <a href="#" class="logo-footer-1">
                    <img src="{{ asset('images/Logo.png') }}" alt="Kenaya Impact">
                </a>

                <a href="#" class="logo-footer-2">
                    <img src="{{ asset('images/logo2.png') }}" alt="Kenaya Impact">
                </a>
            </div>
            <div class="col-12 col-lg-3 footer-column">
                <div class="footer-title">{{ __('footer.column_about') }}</div>
                <div class="footer-links">
                    <a href="#">{{ __('footer.company_history') }}</a>
                    <a href="#">{{ __('footer.mission_vision_values') }}</a>
                    <a href="#">{{ __('footer.transition') }}</a>
                    <a href="#">{{ __('footer.management_team') }}</a>
                </div>
            </div>
            <div class="col-12 col-lg-3 footer-column">
                <div class="footer-title">{{ __('footer.column_activities') }}</div>
                <div class="footer-links">
                    <a href="#">{{ __('footer.intervention_areas') }}</a>
                    <a href="#">{{ __('footer.services_offered') }}</a>
                    <a href="#">{{ __('footer.geographic_coverage') }}</a>
                    <a href="#">{{ __('footer.case_studies') }}</a>
                </div>
            </div>
            <div class="col-12 col-lg-3 footer-column">
                <div class="footer-title">{{ __('footer.column_news') }}</div>
                <div class="footer-links">
                    <a href="#">{{ __('footer.news_blog') }}</a>
                    <a href="#">{{ __('footer.events') }}</a>
                    <a href="#">{{ __('footer.publications') }}</a>
                    <a href="#">{{ __('footer.press_releases') }}</a>
                </div>
            </div>
        </div>

        <div class="row py-5">
            <div class="col text-center wow fadeInUp">
                <p class="mb-3">{{ __('footer.follow_us') }}</p>
                <div class="footer-social">
                    <a href="#"><img src="{{ asset('images/1.png') }}" alt="Facebook"></a>
                    <a href="#"><img src="{{ asset('images/2.png') }}" alt="X"></a>
                    <a href="#"><img src="{{ asset('images/3.png') }}" alt="Instagram"></a>
                    <a href="#"><img src="{{ asset('images/4.png') }}" alt="YouTube"></a>
                    <a href="#"><img src="{{ asset('images/5.png') }}" alt="LinkedIn"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom wow fadeInUp">
        <div>{{ __('footer.copyright_text') }}</div>
        <a href="#">{{ __('footer.legal_notice') }}</a>
    </div>
</footer>
<!-- ********* -->