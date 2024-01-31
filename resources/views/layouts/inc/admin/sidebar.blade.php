<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.dashboard')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Anasayfa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.genre.index')}}">
                <i class="mdi mdi-view-headline menu-icon"></i>
                <span class="menu-title">Kategoriler</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.movie.index')}}">
                <i class="mdi mdi-filmstrip menu-icon"></i>
                <span class="menu-title">Filmler</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.tv.index')}}">
                <i class="mdi mdi-television menu-icon"></i>
                <span class="menu-title">Diziler</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.tag.index')}}">
                <i class="mdi mdi-tag menu-icon"></i>
                <span class="menu-title">Etiketler</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.cast.index')}}">
                <i class="mdi mdi-theater menu-icon"></i>
                <span class="menu-title">Oyuncular</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('smart.dashboard')}}">
                <i class="mdi mdi-currency-usd menu-icon"></i>
                <span class="menu-title">Reklam Ayarları</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.comments.index')}}">
                <i class="mdi mdi-comment menu-icon"></i>
                <span class="menu-title">Yorumlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
                <i class="mdi mdi-account-multiple menu-icon"></i>
                <span class="menu-title">Kullanıcılar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.settings.view')}}">
                <i class="mdi mdi-settings menu-icon"></i>
                <span class="menu-title">Ayarlar</span>
            </a>
        </li>
    </ul>
</nav>
