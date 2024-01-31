@extends('layouts.front')
@section('meta')
    <meta name="robots" content="index,follow">
    <meta name="title" content="{{$movie->title}} {{siteInfo()->site_separator}} {{siteInfo()->site_name}}">
    <meta name="description" content="{{$movie->meta}}">
    <meta name="author" content="{{siteInfo()->site_name}}">
    <link rel="canonical" href="{{Request::url()}}">
    <meta property="og:locale" content="tr_TR" >
    <meta property="og:site_name" content="{{siteInfo()->site_name}}" >
    <meta property="og:title" content="{{$movie->title}} {{siteInfo()->site_separator}} {{siteInfo()->site_name}}">
    <meta property="og:description" content="{{$movie->meta}}">
    <meta property="og:image" content="{{siteInfo()->site_logo}}">
    <meta property="og:url" content="{{Request::url()}}">
@endsection
@section('title', e($movie->title))
@section('description', e($movie->meta))
@section('movie-tags')
    @foreach($movie->tags as $tag)
        <meta property="article:tag" content="{{$tag->tag_name}}" />
    @endforeach
@endsection
@section('front-content')
    <section class="section details">
        <!-- details background -->
        <div class="details__bg" data-bg="img/home/home__bg.jpg"></div>
        <!-- end details background -->

        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <h1 class="details__title">{{$movie->title}}</h1>
                </div>
                <!-- end title -->


                {{-- <div class="col-12">--}}
                {{-- <ul class="paginator paginator--list">--}}
                {{-- @foreach($movie->trailers as $source)--}}
                {{-- <li class="paginator__item"><a href="">{{$source->id}}</a></li>--}}
                {{-- @endforeach--}}

                {{-- </ul>--}}
                {{-- </div>--}}

                <!-- player -->
                <div class="col-12">
                    <div class="card card--details card--series align-content-center">
                        <div class="row">
                            <!-- card content -->
                            <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-9">
                                <div class="card__content">
                                    <div class="card__wrap">
{{--                                        <div id="ad" class="flexible-div">--}}
{{--                                            <x-smart-ad-component slug="video-önü"/>--}}
{{--                                            <div class="skip-ad">--}}
{{--                                                <div id="skip-button">Geç</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

                                        <iframe id="video" src="{{$movie->source}}" width="854" height="480" frameborder="0"
                                                marginwidth="0" marginheight="" scrolling="YES"
                                                allowfullscreen="allowfullscreen">
                                        </iframe>
                                    </div>
                                </div>
                            </div>

                            <!-- end card content -->
                        </div>
{{--                        <div class="video-ad">--}}
{{--                            <x-smart-ad-component slug="video-altı"/>--}}
{{--                        </div>--}}
                        <ul class="card__list">
                            <li role="button" class="errorButton"
                                style="line-height:20px; width: 120px; height:35px; font-size:16px; cursor: pointer; margin-top: 20px;"><i
                                    class="ion-ios-alert"></i>
                                Hata Bildir </li>
                        </ul>
                        <ul class="card__list">
                            <li style="line-height:20px; width: 70px; height:35px; font-size:16px;"><i
                                    class="ion-ios-eye">  </i>  <span class="ms-5">{{$movie->visits}}</span> </li>
                        </ul>
                    </div>
                </div>

{{--                <div id="ad-div" class="ad-div">--}}
{{--                    <button id="close-btn" class="close-btn">X</button>--}}
{{--                    <x-smart-ad-component slug="sayfa-yan"/>--}}
{{--                </div>--}}



                @if(session('status'))
                    <div style="color: lightgreen;">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div style="color: orangered;">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="container" id="error" style="display: none;">
                    <div class="row">
                        <div class="col-12 col-lg-8 col-xl-8">
                            <!-- content tabs -->
                            <div class="row">
                                <!-- reviews -->
                                <div class="col-12">
                                    <div class="reviews">
                                        @if(session('status'))
                                            <div style="color: lightgreen;">
                                                {{ session('status') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <form action="{{route('front.error.submit', $movie->id)}}" class="form" method="post">
                                            @csrf

                                            <textarea name="error" class="form__textarea" placeholder="Aldığınız hata*"></textarea>
                                            <button type="submit" class="form__btn">BİLDİR</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- end reviews -->
                            </div>
                            <!-- end content tabs -->
                        </div>

                        <!-- sidebar -->

                        <!-- end sidebar -->
                    </div>
                </div>
                <!-- end player -->
                <!-- content -->
                <div class="col-10">
                    <div class="card card--details card--series">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-3">
                                <div class="card__cover">
                                    <img src="https://image.tmdb.org/t/p/w500{{$movie->poster_path}}" alt="{{$movie->title}} izle">
                                </div>
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-9">
                                <div class="card__content">
                                    <div class="card__wrap">
                                        <span class="card__rate"><i class="icon ion-ios-star"></i>{{$movie->rating}}</span>

                                        <ul class="card__list">
                                            <li>{{$movie->video_format}}</li>
                                        </ul>
                                    </div>

                                    <ul class="card__meta">
                                        <li><span>Tür:</span>
                                            @foreach($movie->genres as $genre)
                                                <a href="{{route('front.genre.index', $genre)}}">{{$genre->name}}</a>
                                            @endforeach
                                        </li>
                                        <li><span>Yapım yılı:</span> {{$movie->release_date}}</li>
                                        <li><span>Süre:</span>{{$movie->runtime}} dk. </li>
                                        <li><span>Oyuncular:</span>
                                            @foreach($movie->casts as $cast)
                                                <a href="{{route('front.cast.index', $cast)}}">{{$cast->name}}</a>
                                            @endforeach
                                        </li>
                                        <li><span>Etiketler:</span>
                                            @foreach($movie->tags as $tag)
                                                <a href="{{route('front.tag.index', $tag)}}">{{$tag->tag_name}}</a>
                                            @endforeach
                                        </li>
                                        <li><span>Ülke:</span>
                                            <a href="#">{{$movie->country}}</a>
                                        </li>
                                    </ul>
                                    <div class="card__description card__description--details">
                                        {{$movie->overview}}
                                    </div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->

                {{-- <div class="col-12">--}}
                {{-- <div class="details__wrap">--}}
                {{--
                <!-- availables -->--}}
                {{-- <div class="details__devices">--}}
                {{-- <span class="details__devices-title">Available on devices:</span>--}}
                {{-- <ul class="details__devices-list">--}}
                {{-- <li><i class="icon ion-logo-apple"></i><span>IOS</span></li>--}}
                {{-- <li><i class="icon ion-logo-android"></i><span>Android</span></li>--}}
                {{-- <li><i class="icon ion-logo-windows"></i><span>Windows</span></li>--}}
                {{-- <li><i class="icon ion-md-tv"></i><span>Smart TV</span></li>--}}
                {{-- </ul>--}}
                {{-- </div>--}}
                {{--
                <!-- end availables -->--}}

                {{--
                <!-- share -->--}}
                {{-- <div class="details__share">--}}
                {{-- <span class="details__share-title">Share with friends:</span>--}}

                {{-- <ul class="details__share-list">--}}
                {{-- <li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>--}}
                {{-- <li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>--}}
                {{-- <li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>--}}
                {{-- <li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>--}}
                {{-- </ul>--}}
                {{-- </div>--}}
                {{--
                <!-- end share -->--}}
                {{--
            </div>--}}
                {{-- </div>--}}
            </div>
        </div>
        <!-- end details content -->

    </section>
    <!-- end details -->

    <!-- content -->
    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        <!-- content title -->
                        <h2 class="content__title">Yorumlar</h2>

                        <!-- end content title -->




                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-8">

                    <!-- content tabs -->

                    <livewire:front.comments :movie="$movie" />

                    <!-- end content tabs -->

                </div>

                <!-- sidebar -->
                <div class="col-12 col-lg-4 col-xl-4">
                    <div class="row">
                        <!-- section title -->
                        <div class="col-12">
                            <h2 class="section__title section__title--sidebar">Bu filmler de hoşunuza gidebilir:</h2>
                        </div>
                        <!-- end section title -->
                        @foreach ($relatedMovies as $rMovie)
                            <!-- card -->
                            <div class="col-6 col-sm-4 col-lg-6">
                                <div class="card">
                                    <div class="card__cover">
                                        <img src="https://image.tmdb.org/t/p/w500{{$rMovie->poster_path}}" alt="{{$rMovie->title}} izle">
                                        <a href="{{route('front.movie.show', $rMovie->slug)}}" class="card__play">
                                            <i class="icon ion-ios-play"></i>
                                        </a>
                                    </div>
                                    <div class="card__content">
                                        <h3 class="card__title"><a href="#">{{$rMovie->title}}</a></h3>
                                        <span class="card__category">
                                    @foreach ($rMovie->genres as $rMovieGenre)
                                                <a href="#">{{$rMovieGenre->name}}</a>
                                            @endforeach


                                </span>
                                        <span class="card__rate"><i class="icon ion-ios-star"></i>{{$rMovie->rating}}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        @endforeach
                    </div>
                </div>
                <!-- end sidebar -->
            </div>
        </div>
    </section>
    @push('script')
        <script>
            $(document).ready(function(){
                $(".errorButton").click(function(){
                    $("#error").toggle();
                });
            });


        </script>

    @endpush
@endsection

