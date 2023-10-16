@extends('layouts.front-tv')
@section('title', e($title))
@section('meta')
    <meta name="robots" content="index,follow">
    <meta name="title" content="{{$title}} {{siteInfo()->site_separator}} {{siteInfo()->site_name}}">
    <meta name="description" content="{{siteInfo()->site_description}}">
    <meta name="author" content="{{siteInfo()->site_name}}">
    <link rel="canonical" href="{{Request::url()}}">
    <meta property="og:title" content="{{$title}} {{siteInfo()->site_separator}} {{siteInfo()->site_name}}">
    <meta property="og:description" content="{{siteInfo()->site_description}}">
    <meta property="og:image" content="{{siteInfo()->site_logo}}">
    <meta property="og:url" content="{{Request::url()}}">
@endsection
@section('front-content')
    <!-- page title -->
    <section class="section section--first section--bg" data-bg="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h2 class="section__title">{{$title}}</h2>
                        <!-- end section title -->

                        <!-- breadcrumb -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb__item"><a href="{{route('front.welcome')}}">Anasayfa</a></li>
                            <li class="breadcrumb__item breadcrumb__item--active">{{$title}}</li>
                        </ul>
                        <!-- end breadcrumb -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- filter -->
    <div class="filter">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="filter__content">
                        <div class="filter__items">
                            <!-- filter item -->
                            <div class="filter__item" id="filter__genre">
                                <span class="filter__item-label">Kategori:</span>

                                <div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <input type="button" value="Aksiyon">
                                    <span></span>
                                </div>

                                <ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-genre">
                                    @foreach($genres as $genre)
                                        <li>{{$genre->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end filter item -->

                            <!-- filter item -->

                            <!-- end filter item -->

                            <!-- filter item -->
                            <div class="filter__item" id="filter__rate">
                                <span class="filter__item-label">IMDB Puanı:</span>

                                <div class="filter__item-btn dropdown-toggle" role="button" id="filter-rate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="filter__range">
                                        <div id="filter__imbd-start"></div>
                                        <div id="filter__imbd-end"></div>
                                    </div>
                                    <span></span>
                                </div>

                                <div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-rate">
                                    <div id="filter__imbd"></div>
                                </div>
                            </div>
                            <!-- end filter item -->

                            <!-- filter item -->
                            <div class="filter__item" id="filter__year">
                                <span class="filter__item-label">Yapım Yılı:</span>

                                <div class="filter__item-btn dropdown-toggle" role="button" id="filter-year" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="filter__range">
                                        <div id="filter__years-start"></div>
                                        <div id="filter__years-end"></div>
                                    </div>
                                    <span></span>
                                </div>

                                <div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-year">
                                    <div id="filter__years"></div>
                                </div>
                            </div>
                            <!-- end filter item -->
                        </div>

                        <!-- filter btn -->
                        <button class="filter__btn" type="button">Filtreyi Uygula</button>
                        <!-- end filter btn -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end filter -->

    <!-- catalog -->
    <div class="catalog">
        <div class="container">
            <div class="row">
                <!-- card -->
                @foreach($tvshows as $tvshow)
                    <div class="col-6 col-sm-12 col-lg-6">
                        <div class="card card--list">
                            <div class="row">
                                <div class="col-12 col-sm-4">
                                    <div class="card__cover">
                                        <img src="https://image.tmdb.org/t/p/w500{{$tvshow->poster_path}}" alt="">
{{--                                        <a href="{{route('front.episode.show', $tvshow->slug)}}" class="card__play">--}}
                                            <i class="icon ion-ios-play"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-8">
                                    <div class="card__content">
                                        <h3 class="card__title"><a href="{{route('front.tv.show', $tvshow->slug)}}">{{$tvshow->name}}</a></h3>
                                        <span class="card__category">
										@foreach($tvshow->genres as $genre)
                                                <a href="{{route('front.genre.index', $genre)}}">{{$genre->name}}</a>
                                            @endforeach
									</span>

{{--                                        <div class="card__wrap">--}}
{{--                                            <span class="card__rate"><i class="icon ion-ios-star"></i>{{$movie->rating}}</span>--}}

{{--                                            <ul class="card__list">--}}
{{--                                                <li>{{$movie->video_format}}</li>--}}
{{--                                            </ul>--}}
{{--                                        </div>--}}

                                        <div class="card__description">
                                            <p>{{$tvshow->overview}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                @endforeach
            </div>
            {{--            {{ $movies->links('vendor.pagination.custom') }}--}}
        </div>
    </div>
    <!-- end catalog -->
@endsection
