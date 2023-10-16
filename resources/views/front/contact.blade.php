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

    <section class="content">
        <div class="content__head">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <!-- content title -->
                        <h2 class="content__title">Bizimle İletişime Geçin</h2>
                        <!-- end content title -->

                        <!-- content tabs nav -->

                        <!-- end content tabs nav -->

                        <!-- content mobile tabs nav -->

                        <!-- end content mobile tabs nav -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
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

                                        <form action="{{route('front.contact.submit')}}" class="form" method="post">
                                            @csrf
                                            <input name="name" type="text" class="form__input" placeholder="Adınız*">
                                            <input name="email" type="email" class="form__input" placeholder="E-posta Adresiniz*">
                                            <textarea name="message" class="form__textarea" placeholder="Mesajınız*"></textarea>

                                            <button type="submit" class="form__btn">Gönder</button>
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
    </section>

@endsection
