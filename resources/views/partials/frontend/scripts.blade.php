
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!--**************  -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

<!-- ********* -->

<script>
    new WOW().init();
</script>

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

<script>
    const headers = document.querySelectorAll('.custom-accordion-header');

    headers.forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            const body = item.querySelector('.custom-accordion-body');
            const isActive = item.classList.contains('active');

            // Ferme tous les autres
            document.querySelectorAll('.custom-accordion-item').forEach(el => {
                const b = el.querySelector('.custom-accordion-body');
                el.classList.remove('active');
                b.style.height = '0px';
                b.style.visibility = 'hidden';
                b.style.opacity = '0';
                el.querySelector('.icon').textContent = '+';
            });

            // Ouvre celui-ci
            if (!isActive) {
                item.classList.add('active');
                body.style.height = body.scrollHeight + 'px';
                body.style.visibility = 'visible';
                body.style.opacity = '1';
                header.querySelector('.icon').textContent = '−';
            }
        });
    });

    // Initialise la hauteur de l'actif à l'ouverture
    window.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.custom-accordion-item.active .custom-accordion-body')
            .forEach(el => {
                el.style.height = el.scrollHeight + 'px';
                el.style.visibility = 'visible';
                el.style.opacity = '1';
            });
    });
</script>

<script>
    new Swiper('.temoignages-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: {
        nextEl: '.temoignages-next',
        prevEl: '.temoignages-prev',
        },
    });

    new Swiper('.offer-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: {
        nextEl: '.offer-next',
        prevEl: '.offer-prev',
        },
    });
</script>

<script>
    new Swiper('.blog-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: {
        nextEl: '.blog-next',
        prevEl: '.blog-prev',
        },
    });

    new Swiper('.event-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: {
        nextEl: '.event-next',
        prevEl: '.event-prev',
        },
    });

    new Swiper('.event1-swiper', {
        slidesPerView: 'auto',
        spaceBetween: 20,
        navigation: {
        nextEl: '.event1-next',
        prevEl: '.event1-prev',
        },
    });
</script>
