
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap-reboot.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/bootstrap-grid.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/default-skin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/main.css')}}">

    <!-- Favicons -->
    <link rel="shortcut icon" href="{{siteInfo()->site_favicon}}" type="image/x-icon">
{{--    <link rel="apple-touch-icon" href="icon/favicon-32x32.png">--}}
{{--    <link rel="apple-touch-icon" sizes="72x72" href="icon/apple-touch-icon-72x72.png">--}}
{{--    <link rel="apple-touch-icon" sizes="114x114" href="icon/apple-touch-icon-114x114.png">--}}
{{--    <link rel="apple-touch-icon" sizes="144x144" href="icon/apple-touch-icon-144x144.png">--}}


        <title>Sayfa Bulunamadı</title>
        <meta name="robots" content="noindex, nofollow">
        <meta name="title" content="Sayfa Bulunamadı {{siteInfo()->site_separator}} {{siteInfo()->site_name}}">
        <meta name="description" content="{{siteInfo()->site_description}}">
        <meta name="author" content="{{siteInfo()->site_name}}">
        <link rel="canonical" href="{{Request::root()}}">


</head>
<body class="body">

<!-- page 404 -->
<div class="page-404 section--bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-404__wrap">
                    <div class="page-404__content">
                        <h1 class="page-404__title">404</h1>
                        <p class="page-404__text">Aradığınız sayfa bulunamadı!</p>
                        <a href="{{route('front.welcome')}}" class="page-404__btn">ANASAYFAYA DÖN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end page 404 -->

<!-- JS -->
<script src="{{asset('assets/front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/front/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/front/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.mousewheel.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.mCustomScrollbar.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery.morelines.min.js')}}"></script>
<script src="{{asset('assets/front/js/photoswipe.min.js')}}"></script>
<script src="{{asset('assets/front/js/main.js')}}"></script>

</body>

</html>
