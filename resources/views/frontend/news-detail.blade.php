@extends('layouts.frontend.master')

@section('title', $article->news_title . ' - Keneya')
@section('description', Str::limit($article->news_description, 160))

@section('content')
    <!-- ***** ARTICLE DETAIL SECTION ***** -->
    <section class="article-detail mgt">
        <div class="container-lg">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="wow fadeInLeft">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('front.home') }}">{{ __('news.home') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('front.news') }}">{{ __('news.title') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $article->news_title }}</li>
                </ol>
            </nav>

            <!-- Article Header -->
            <div class="section--title wow fadeInLeft">
                <h1>{{ $article->news_title }}</h1>
                <div class="article-meta">
                    <span class="article-type">
                        @if($article->news_type === 'blog')
                            {{ __('news.blog') }}
                        @elseif($article->news_type === 'event')
                            {{ __('news.events') }}
                        @elseif($article->news_type === 'publication')
                            {{ __('news.publications') }}
                        @elseif($article->news_type === 'press_release')
                            {{ __('news.press_releases') }}
                        @endif
                    </span>
                    <span class="article-date">{{ $article->created_at->format('d/m/Y') }}</span>
                </div>
            </div>

            <!-- Article Image -->
            @if($article->news_image)
                <div class="article-image wow fadeInRight">
                    <img src="{{ asset($article->news_image) }}"
                         alt="{{ $article->news_title }}"
                         class="img-fluid">
                </div>
            @endif

            <!-- Article Content -->
            <div class="article-content wow fadeInUp">
                <div class="article-description">
                    <p class="lead">{{ $article->news_description }}</p>
                </div>

                @if($article->news_full_content)
                    <div class="article-body">
                        {!! nl2br(e($article->news_full_content)) !!}
                    </div>
                @endif

                @if($article->news_link)
                    <div class="article-link">
                        <a href="{{ $article->news_link }}"
                           class="btn-site"
                           target="_blank"
                           rel="noopener noreferrer">
                            <span>{{ __('news.read_more') }}</span>
                            <span class="arrow">→</span>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Back Button -->
            <div class="article-back wow fadeInUp">
                <a href="{{ route('front.news') }}" class="btn-site">
                    <span>← {{ __('news.back_to_news') }}</span>
                </a>
            </div>
        </div>
    </section>

    <!-- ***** RELATED ARTICLES SECTION ***** -->
    @if($relatedArticles->count() > 0)
        <section class="related-articles">
            <div class="container-lg">
                <div class="section--title wow fadeInLeft">
                    <h2>{{ __('news.related_articles') }}</h2>
                </div>

                <div class="row wow fadeInRight">
                    @foreach($relatedArticles as $relatedArticle)
                        <div class="col-md-4 mb-4">
                            <div class="cardBlog">
                                <a href="{{ route('front.news.show', $relatedArticle->news_slug) }}">
                                    <div class="cardBlog--img">
                                        <img src="{{ $relatedArticle->news_image ? asset($relatedArticle->news_image) : asset('img/default.jpg') }}"
                                            alt="{{ $relatedArticle->news_title }}">
                                    </div>
                                    <div class="cardBlog--body">
                                        <h3>{{ $relatedArticle->news_title }}</h3>
                                        <p>{{ Str::limit($relatedArticle->news_description, 100) }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@section('styles')
    <style>
        .article-detail {
            padding: 6rem 0 4rem;
        }

        .breadcrumb {
            background: transparent;
            padding: 0 0 2rem 0;
            margin: 0;
            font-size: 14px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "›";
            color: #666;
        }

        .breadcrumb-item a {
            color: #00A3C6;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-item a:hover {
            color: #F59200;
        }

        .breadcrumb-item.active {
            color: #666;
        }

        .article-meta {
            display: flex;
            gap: 20px;
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .article-type {
            background: #00A3C6;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
        }

        .article-date {
            display: flex;
            align-items: center;
        }

        .article-image {
            margin: 3rem 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .article-image img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
        }

        .article-content {
            margin: 3rem 0;
        }

        .article-description {
            margin-bottom: 2rem;
        }

        .article-description .lead {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            line-height: 1.6;
        }

        .article-body {
            font-size: 16px;
            line-height: 1.8;
            color: #444;
            margin-bottom: 2rem;
        }

        .article-link {
            margin: 3rem 0;
        }

        .article-back {
            margin: 2rem 0;
        }

        .related-articles {
            background: #f8f9fa;
            padding: 4rem 0;
        }

        @media only screen and (max-width: 768px) {
            .article-detail {
                padding: 4rem 0 2rem;
            }

            .article-image img {
                max-height: 300px;
            }

            .article-meta {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
@endsection
