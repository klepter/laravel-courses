<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('stylesheets/foundation.min.css')}}">
    <link rel="stylesheet" href="{{asset('stylesheets/main.css')}}">
    <link rel="stylesheet" href="{{asset('stylesheets/app.css')}}">
    <script src="{{asset('javascripts/modernizr.foundation.js')}}"></script>
    <link rel="stylesheet" href="{{asset('fonts/ligature.css')}}">
    <!-- Google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic'
          rel='stylesheet' type='text/css'/>
    <!--[if lt IE 9]>
    <script src="https://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<!-- ######################## Main Menu ######################## -->
<nav>
    <div class="twelve columns header_nav">
        <div class="row header-nav">
            <ul id="menu-header" class="nav-bar horizontal">
                <li><a href="/">Главная</a></li>
                <li><a href="/courses/en">Английский</a></li>
                <li><a href="/courses/fr">Французский</a></li>
                <li><a href="/courses/de">Немецкий</a></li>
                <li><a href="/courses/cn">Китайский</a></li>
                @can('user')
                    <li><a href="/user/courses">Мои курсы</a></li>
                @endauth
                @can('admin')
                    <li><a href="/admin">Админ-панель</a></li>
                @endcan
            </ul>
            <div class="user-sign">
                @if(Auth::check())
                    <div class="user-info">
                        <img src="{{asset('storage/images/' . Auth::user()->image)}}" alt="{{Auth::user()->name}}">
                        <div class="user-details">
                            <div>Добро пожаловать, {{Auth::user()->name}}</div>
                            <div class="user-controls">
                                <form method="POST" action="{{route('logout')}}">
                                    @csrf
                                    <input type="submit" value="Выход">
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div><a href="/login">Вход</a></div> |
                    <div><a href="/register">Регистрация</a></div>
                @endif
            </div>
        </div>
    </div>
</nav>
<!-- ######################## Header (featured posts) ######################## -->
<header>
    <div class="row">
        <h1>@yield('header')</h1>
        @yield('header-content')
    </div>
</header>
<!-- ######################## Section ######################## -->
@yield('content')

<!-- ######################## Footer ######################## -->
<footer>
    <div class="row">
        <div class="twelve columns footer">
            <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="twitter">Twitter</a>
            <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="facebook">Facebook</a>
            <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="pinterest">Pinterest</a>
            <a href="" class="lsf-icon" style="font-size:16px" title="instagram">Instagram</a>
        </div>
    </div>
</footer>
<!-- ######################## Scripts ######################## -->
<!-- Included JS Files (Compressed) -->
<script src="{{asset('javascripts/foundation.min.js')}}" type="text/javascript"></script>
<!-- Initialize JS Plugins -->
<script src="{{asset('javascripts/app.js')}}" type="text/javascript"></script>
</body>
</html>
