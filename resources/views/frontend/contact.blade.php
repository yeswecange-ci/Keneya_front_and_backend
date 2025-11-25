@extends('layouts.frontend.master')

@section('title', __('contact.title') . ' - Keneya')
@section('description', __('contact.subtitle'))

@section('content')
    <!-- Contact -->
    <section class="contact mgt">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h1>{{ __('contact.title') }}</h1>
                <h2></h2>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <p class="wow fadeInRight">{{ __('contact.contact_description') }}</p>
        </div>

        <!-- *** -->
        <img src="{{ asset('img/9.png') }}" alt="img-people" class="img--contact wow fadeInLeft">

        <!-- *** -->
        <div class="container-lg">
            <!-- formulaire -->
            <form class="form-candidature wow fadeInRight" action="{{ route('contact.quote.store') }}" method="POST">
                @csrf
                <input type="text" name="first_name" placeholder="{{ __('contact.first_name') }}" required>
                <input type="text" name="last_name" placeholder="{{ __('contact.last_name') }}" required>

                <div class="row-double">
                    <input type="email" name="email" placeholder="{{ __('contact.email_address') }}" required>
                    <input type="tel" name="phone" placeholder="{{ __('contact.phone_number') }}" required>
                </div>

                <textarea name="message" placeholder="{{ __('contact.message_placeholder') }}" rows="5"></textarea>

                <button class="btn-site1" type="submit">
                    <span>{{ __('contact.send') }}</span>
                    <span class="arrow">→</span>
                </button>
            </form>
        </div>

        <img src="{{ asset('img/9.png') }}" alt="img-people" class="img--contact1 wow fadeInLeft">
    </section>
    <!-- *** -->

    <section class="findUs">
        <div class="container-lg wow fadeInRight">
            <div class="section--title">
                <h2>{{ __('contact.find_us') }}</h2>
            </div>

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16801.114518740127!2d-3.9994224484780414!3d5.312937414646711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ebf60b2e34af%3A0xa62c41360300c47!2sMarcory%20Residentiel%2C%20Abidjan!5e1!3m2!1sfr!2sci!4v1754061918651!5m2!1sfr!2sci"
                width="100%" height="361" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

@endsection