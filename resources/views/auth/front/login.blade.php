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
                    <!-- authorization form -->
                    <form method="POST" action="{{ route('login') }}" class="sign__form">
                        @csrf
                        <a href="{{route('front.welcome')}}" class="sign__logo">
                            <img src="{{siteInfo()->site_logo}}" alt="">
                        </a>

                        <div class="sign__group">
                            <input id="email" type="email" class="sign__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-posta">
                            @error('email')
                            <div style="color: orangered;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="sign__group">
                            <input id="password" type="password"  name="password" required autocomplete="current-password" class="sign__input @error('password') is-invalid @enderror" placeholder="Şifre">
                            @error('password')
                            <div style="color: orangered;">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="sign__group sign__group--checkbox">
                            <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox">
                            <label for="remember">Beni Hatırla</label>
                        </div>

                        <button class="sign__btn" type="submit">Oturum Aç</button>
                        @if (Route::has('register'))
                        <span class="sign__text">Hesabınız yok mu? <a href="{{ route('register') }}">Kayıt Ol</a></span>
                        @endif
                        @if (Route::has('password.request'))
                        <span class="sign__text"><a href="{{ route('password.request') }}">Şifrenizi mi unuttunuz?</a></span>
                        @endif
                    </form>
                    <!-- end authorization form -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/front/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/front/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
