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
    <link rel="stylesheet" href="{{asset('assets/front/css/default-skin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/css/ionicons.min.css')}}">

    <!-- Favicons -->
    <link rel="icon" href="{{siteInfo()->site_favicon}}" type="image/x-icon">
    <meta name="robots" content="index,follow">
    <meta name="title" content="{{$title}} {{siteInfo()->site_separator}} {{siteInfo()->site_name}}">
    <meta name="description" content="{{siteInfo()->site_description}}">
    <meta name="author" content="{{siteInfo()->site_name}}">
    <link rel="canonical" href="{{Request::root()}}">
    <meta property="og:title" content="{{$title}} {{siteInfo()->site_separator}} {{siteInfo()->site_name}}">
    <meta property="og:description" content="{{siteInfo()->site_description}}">
    <meta property="og:image" content="{{siteInfo()->site_logo}}">
    <meta property="og:url" content="{{Request::url()}}">
    <title>{{$title}} {{siteInfo()->site_separator}} {{siteInfo()->site_name}}</title>

</head>
<body class="body">

<div class="sign section--bg" data-bg="img/section/section.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- registration form -->
                    <form action="{{ route('register') }}" class="sign__form">
                        @csrf
                        <a href="{{route('front.welcome')}}" class="sign__logo">
                            <img src="{{siteInfo()->site_logo}}" alt="">
                        </a>

                        <div class="sign__group">
                            <input id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus type="text" class="sign__input @error('name') is-invalid @enderror" placeholder="İsim">
                            @error('name')
                            <div style="color: orangered;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="sign__group">
                            <input id="email" type="email" class="sign__input @error('email') is-invalid @enderror" placeholder="E-posta" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <div style="color: orangered;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="sign__group">
                            <input id="password" type="password" class="sign__input @error('password') is-invalid @enderror" placeholder="Şifrenizi Girin" name="password" required autocomplete="new-password">
                            @error('password')
                            <div style="color: orangered;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="sign__group">
                            <input id="password-confirm" type="password" class="sign__input @error('password') is-invalid @enderror" placeholder="Şifrenizi Tekrar Girin" name="password_confirmation" required autocomplete="new-password">
                            @error('password')
                            <div style="color: orangered;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="sign__btn" type="submit">Kayıt Ol</button>

                        <span class="sign__text">Hesabınız mı var? <a href="{{route('front.user.login')}}">Oturum Aç</a></span>
                    </form>
                    <!-- registration form -->
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
