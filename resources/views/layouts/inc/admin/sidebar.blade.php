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
            <a class="nav-link" data-bs-toggle="collapse" href="#posts" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-circle-outline menu-icon"></i>
                <span class="menu-title">Filmler</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="posts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('back.movie.index')}}">Filmler</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{--{{route('back.post.index')}}--}}">Yeni Film
                            Ekle</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('back.tv.index')}}">
                <i class="mdi mdi-tag menu-icon"></i>
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
                <i class="mdi mdi-comment menu-icon"></i>
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
        <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
                <i class="mdi mdi-emoticon menu-icon"></i>
                <span class="menu-title">Icons</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="documentation/documentation.html">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
