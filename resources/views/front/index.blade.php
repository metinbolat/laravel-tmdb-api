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

    @livewire('front.movie.filter-movies')
@endsection
