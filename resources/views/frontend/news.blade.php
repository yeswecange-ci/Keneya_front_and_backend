@extends('layouts.frontend.master')

@section('title', __('news.title') . ' - Keneya')
@section('description', __('news.subtitle'))

@section('content')
    <!-- ***** BLOG SECTION ***** -->
    <section class="blog mgt">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h1>{{ __('news.title') }}</h1>
                <h2>{{ __('news.blog_subtitle') }}</h2>
            </div>

            @if($blogArticles->count() > 0)
                <div class="swiper blog-swiper wow fadeInRight">
                    <div class="swiper-wrapper">
                        @foreach($blogArticles as $article)
                            <div class="swiper-slide">
                                <div class="cardBlog">
                                    <a href="{{ $article->news_link ?? '#' }}">
                                        <div class="cardBlog--img">
                                            <img src="{{ $article->news_image ? asset($article->news_image) : asset('img/default.jpg') }}"
                                                alt="{{ $article->news_title }}">
                                        </div>
                                        <div class="cardBlog--body">
                                            <h3>{{ $article->news_title }}</h3>
                                            <p>{{ Str::limit($article->news_description, 150) }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($blogArticles->count() > 1)
                        <div class="navigation-buttons-swiper">
                            <div class="swiper-button-prev blog-prev"></div>
                            <div class="swiper-button-next blog-next"></div>
                        </div>
                    @endif
                </div>
            @else
                <div class="alert alert-info">
                    <p>{{ __('news.no_articles_blog') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ***** EVENTS SECTION ***** -->
    <section class="event">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h2>{{ __('news.events') }}</h2>
            </div>

            @if($eventArticles->count() > 0)
                <div class="swiper event-swiper wow fadeInRight">
                    <div class="swiper-wrapper">
                        @foreach($eventArticles as $article)
                            <div class="swiper-slide">
                                <div class="cardBlog">
                                    <a href="{{ $article->news_link ?? '#' }}">
                                        <div class="cardBlog--img">
                                            <img src="{{ $article->news_image ? asset($article->news_image) : asset('img/default.jpg') }}"
                                                alt="{{ $article->news_title }}">
                                        </div>
                                        <div class="cardBlog--body">
                                            <h3>{{ $article->news_title }}</h3>
                                            <p>{{ Str::limit($article->news_description, 150) }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($eventArticles->count() > 1)
                        <div class="navigation-buttons-swiper">
                            <div class="swiper-button-prev event-prev"></div>
                            <div class="swiper-button-next event-next"></div>
                        </div>
                    @endif
                </div>
            @else
                <div class="alert alert-info">
                    <p>{{ __('news.no_articles_events') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ***** PUBLICATIONS SECTION ***** -->
    <section class="publications">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h2>{{ __('news.publications') }}</h2>
            </div>

            @if($publicationArticles->count() > 0)
                <div class="swiper event1-swiper wow fadeInRight">
                    <div class="swiper-wrapper">
                        @foreach($publicationArticles as $article)
                            <div class="swiper-slide">
                                <div class="cardBlog">
                                    <a href="{{ $article->news_link ?? '#' }}">
                                        <div class="cardBlog--img">
                                            <img src="{{ $article->news_image ? asset($article->news_image) : asset('img/default.jpg') }}"
                                                alt="{{ $article->news_title }}">
                                        </div>
                                        <div class="cardBlog--body">
                                            <h3>{{ $article->news_title }}</h3>
                                            <p>{{ Str::limit($article->news_description, 150) }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($publicationArticles->count() > 1)
                        <div class="navigation-buttons-swiper">
                            <div class="swiper-button-prev event1-prev"></div>
                            <div class="swiper-button-next event1-next"></div>
                        </div>
                    @endif
                </div>
            @else
                <div class="alert alert-info">
                    <p>{{ __('news.no_articles_publications') }}</p>
                </div>
            @endif
        </div>
    </section>

    <!-- ***** PRESS RELEASES SECTION ***** -->
    <section class="com--blog">
        <div class="container-lg">
            <div class="section--title wow fadeInLeft">
                <h2>{{ __('news.press_releases') }}</h2>
            </div>

            @if($pressReleaseArticles->count() > 0)
                <div class="row wow fadeInRight">
                    @foreach($pressReleaseArticles as $article)
                        <div class="col-md-4 mb-4">
                            <div class="cardBlog">
                                <a href="{{ $article->news_link ?? '#' }}">
                                    <div class="cardBlog--img">
                                        <img src="{{ $article->news_image ? asset($article->news_image) : asset('img/default.jpg') }}"
                                            alt="{{ $article->news_title }}">
                                    </div>
                                    <div class="cardBlog--body">
                                        <h3>{{ $article->news_title }}</h3>
                                        <p>{{ Str::limit($article->news_description, 150) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">
                    <p>{{ __('news.no_articles_press') }}</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Swiper Blog
            if (document.querySelector('.blog-swiper')) {
                new Swiper('.blog-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: '.blog-next',
                        prevEl: '.blog-prev',
                    },
                    breakpoints: {
                        768: { slidesPerView: 2 },
                        1024: { slidesPerView: 3 }
                    }
                });
            }

            // Swiper Events
            if (document.querySelector('.event-swiper')) {
                new Swiper('.event-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: '.event-next',
                        prevEl: '.event-prev',
                    },
                    breakpoints: {
                        768: { slidesPerView: 2 },
                        1024: { slidesPerView: 3 }
                    }
                });
            }

            // Swiper Publications - CORRIGÉ
            if (document.querySelector('.event1-swiper')) {
                new Swiper('.event1-swiper', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: '.event1-next',
                        prevEl: '.event1-prev',
                    },
                    breakpoints: {
                        576: { slidesPerView: 2 },
                        768: { slidesPerView: 3 },
                        1024: { slidesPerView: 4 }
                    }
                });
            }
        });
    </script>
@endsection