@extends('layouts.front')
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
@section('title', e($title))
@section('front-content')
    <section class="home home--bg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="home__title"><b>8 VE ÜZERİ PUANLI</b> FİLMLER</h1>

                    <button class="home__nav home__nav--prev" type="button">
                        <i class="icon ion-ios-arrow-round-back"></i>
                    </button>
                    <button class="home__nav home__nav--next" type="button">
                        <i class="icon ion-ios-arrow-round-forward"></i>
                    </button>
                </div>

                <div class="col-12">
                    <div class="owl-carousel home__carousel">
                        @foreach($sliderMovies as $movie)
                            <div class="item">
                                <!-- card -->
                                <div class="card card--big">
                                    <div class="card__cover">
                                        <img src="https://image.tmdb.org/t/p/w500{{$movie->poster_path}}" alt="{{$movie->title}} izle">
                                        <a href="{{route('front.movie.show', $movie->slug)}}" class="card__play">
                                            <i class="icon ion-ios-play"></i>
                                        </a>
                                    </div>
                                    <div class="card__content">
                                        <h3 class="card__title"><a href="{{route('front.movie.show', $movie->slug)}}">{{$movie->title}}</a></h3>
                                        <span class="card__category">
										@foreach($movie->genres as $genre)
                                                <a href="{{route('front.genre.index', $genre)}}">{{$genre->name}}</a>
                                            @endforeach
									</span>
                                        <span class="card__rate"><i class="icon ion-ios-star"></i>{{$movie->rating}}</span>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Yeni eklenenler</h2>
                        <!-- end content title -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- content tabs -->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="1-tab">
                    <div class="row">
                        <!-- card -->
                        @foreach($newMovies as $movie)
                            <div class="col-6 col-sm-12 col-lg-6">
                                <div class="card card--list">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="card__cover">
                                                <img src="https://image.tmdb.org/t/p/w500{{$movie->poster_path}}" alt="{{$movie->title}} izle">
                                                <a href="{{route('front.movie.show', $movie->slug)}}" class="card__play">
                                                    <i class="icon ion-ios-play"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-8">
                                            <div class="card__content">
                                                <h3 class="card__title"><a href="{{route('front.movie.show', $movie->slug)}}">{{$movie->title}}</a></h3>
                                                <span class="card__category">
                                            @foreach($movie->genres as $genre)
                                                        <a href="{{route('front.genre.index', $genre)}}">{{$genre->name}}</a>
                                                    @endforeach
											</span>

                                                <div class="card__wrap">
                                                    <span class="card__rate"><i class="icon ion-ios-star"></i>{{$movie->rating}}</span>

                                                    <ul class="card__list">
                                                        <li>{{$movie->video_format}}</li>
                                                    </ul>
                                                </div>

                                                <div class="card__description">
                                                    <p>{{$movie->overview}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- end card -->
                    </div>
                    <!-- end content tabs -->
                </div>
    </section>
@endsection
