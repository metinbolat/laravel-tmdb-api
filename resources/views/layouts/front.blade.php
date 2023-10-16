<!doctype html>
<html lang="tr">

<head>
    <!-- Google tag (gtag.js) -->
{{--    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DNZ7C55QFE"></script>--}}
{{--    <script>--}}
{{--        window.dataLayer = window.dataLayer || [];--}}
{{--        function gtag(){dataLayer.push(arguments);}--}}
{{--        gtag('js', new Date());--}}

{{--        gtag('config', 'G-DNZ7C55QFE');--}}
{{--    </script>--}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-9">
    <META HTTP-EQUIV="Content-language" CONTENT="tr">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('movie-tags')
    @yield('meta')

    <title>@yield('title') {{siteInfo()->site_separator}} {{siteInfo()->site_name}}</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/nouislider.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/plyr.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/photoswipe.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/default-skin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/ad.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/style.css')}}">

    <!-- Favicons -->
    <link rel="icon" href="{{siteInfo()->site_favicon}}" type="image/x-icon">
    {{--    <link rel="icon" type="image/png" href="{{asset('assets/front/icon/favicon-32x32.png')}}" sizes="32x32">--}}
    {{--    <link rel="apple-touch-icon" href="{{asset('assets/front/icon/favicon-32x32.png')}}">--}}
    {{--    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/front/icon/apple-touch-icon-72x72.png')}}">--}}
    {{--    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/front/icon/apple-touch-icon-114x114.png')}}">--}}
    {{--    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/front/icon/apple-touch-icon-144x144.png')}}">--}}

    @livewireStyles
</head>

<body class="body">
<!-- header -->
<header class="header">
    <div class="header__wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header__content">
                        <!-- header logo -->
                        <a href="{{route('front.welcome')}}" class="header__logo">
                            <img src="{{siteInfo()->site_logo}}" alt="{{siteInfo()->site_name}}">
                        </a>
                        <!-- end header logo -->

                        <!-- header nav -->
                        <ul class="header__nav">
                            <li class="header__nav-item">
                                <a href="{{route('front.welcome')}}" class="header__nav-link">Ana Sayfa</a>
                            </li>
                            <li class="header__nav-item">
                                <a href="{{route('front.movie.index')}}" class="header__nav-link">FİLMLER</a>
                            </li>

                            <!-- dropdown -->
                            <li class="header__nav-item">
                                <a class="dropdown-toggle header__nav-link" href="#" role="button"
                                   id="dropdownMenuCatalog" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">KATEGORİLER</a>

                                <ul class="dropdown-menu header__dropdown-menu"
                                    aria-labelledby="dropdownMenuCatalog">
                                    @foreach($genres as $genre)
                                        <li><a href="{{route('front.genre.index', $genre->slug)}}">{{$genre->name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <!-- end dropdown -->

                            <li class="header__nav-item">
                                <a href="{{route('front.contact')}}" class="header__nav-link">İLETİŞİM</a>
                            </li>
                        </ul>
                        <!-- end header nav -->

                        <!-- header auth -->
                        <div class="header__auth">
                            <button class="header__search-btn" type="button">
                                <i class="icon ion-ios-search"></i>
                            </button>
                            @auth
                                <a class="header__sign-in" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="icon ion-ios-log-out"></i>
                                    <span>Çıkış Yap</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <a href="{{route('front.user.login')}}" class="header__sign-in" >
                                    <i class="icon ion-ios-log-in"></i>
                                    <span>Oturum Aç</span>
                                </a>
                            @endauth
                        </div>

                        <!-- end header auth -->

                        <!-- header menu btn -->
                        <button class="header__btn" type="button">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <!-- end header menu btn -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- header search -->
    <livewire:front.search />
    <!-- end header search -->
</header>
<!-- end header -->

<!-- home -->

<!-- end home -->

<!-- content -->
@yield('front-content')
<!-- end content -->

<!-- expected premiere -->
@if(Request::url() != route('front.contact'))
    <x-favorite-movies/>
@endif

<!-- end expected premiere -->

<!-- partners -->

<!-- end partners -->

<!-- footer -->
<footer class="footer">
    <div class="container">
        <div class="row">


            <!-- footer list -->
            <div class="col-6 col-sm-4 col-md-3">
                <h6 class="footer__title">Menü</h6>
                <ul class="footer__list">
                    <li><a href="{{route('front.welcome')}}">Ana Sayfa</a></li>
                    <li><a href="{{route('front.contact')}}">İletişim</a></li>
                </ul>
            </div>
            <!-- end footer list -->

            <!-- footer list -->
            <div class="col-6 col-sm-4 col-md-3">
                <h6 class="footer__title">Filmler</h6>
                <ul class="footer__list">
                    <li><a href="{{route('front.favorite.index')}}">En Çok İzlenen Filmler</a></li>
                    <li><a href="{{route('front.movie.index')}}">Tüm Filmler</a></li>
                </ul>
            </div>
            <!-- end footer list -->

            <!-- footer list -->
            <div class="col-12 col-sm-4 col-md-3">
                <h6 class="footer__title">İletişim</h6>
                <ul class="footer__list">
                    <li><a href="mailto:{{siteInfo()->site_email}}">{{siteInfo()->site_email}}</a></li>
                </ul>
                <ul class="footer__social">
                    <li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>
                    <li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>
                    <li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>
                    <li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>
                </ul>
            </div>
            <!-- end footer list -->

            <!-- footer copyright -->
            <div class="col-12">
                <div class="footer__copyright">
                    <small>{!!siteInfo()->site_footertext!!}</small>


                </div>
            </div>
            <!-- end footer copyright -->
        </div>
    </div>
</footer>
<!-- end footer -->

<!-- JS -->
<script src="{{asset('assets/front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/front/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.mousewheel.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.mCustomScrollbar.min.js')}}"></script>
<script src="{{asset('assets/front/js/wNumb.js')}}"></script>
<script src="{{asset('assets/front/js/nouislider.min.js')}}"></script>
<script src="{{asset('assets/front/js/plyr.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.morelines.min.js')}}"></script>
<script src="{{asset('assets/front/js/photoswipe.min.js')}}"></script>
<script src="{{asset('assets/front/js/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('assets/front/js/main.js')}}"></script>
{{--<script src="{{asset('assets/front/js/ad.js')}}"></script>--}}
@livewireScripts
@stack('script')
</body>

</html>
