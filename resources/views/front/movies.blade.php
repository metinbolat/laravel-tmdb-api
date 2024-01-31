@extends('layouts.front')
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
                @foreach($movies as $movie)
                <div class="col-6 col-sm-12 col-lg-6">
                    <div class="card card--list">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="card__cover">
                                    <img src="https://image.tmdb.org/t/p/w500{{$movie->poster_path}}" alt="">
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
                <!-- end card -->
                @endforeach
            </div>
{{--            {{ $movies->links('vendor.pagination.custom') }}--}}
        </div>
    </div>
    <!-- end catalog -->
@endsection
