<!DOCTYPE html>
<html lang="french">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Chromatique team">
    <meta name="keywords" content="Manga, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chromatique</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href=<?= asset('assets/css/bootstrap.min.css') ?> type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/font-awesome.min.css') ?> type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/elegant-icons.css') ?> type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/plyr.css') ?> type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/nice-select.css') ?> type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/owl.carousel.min.css') ?> type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/slicknav.min.css') ?> type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/style.css') ?> type="text/css">
</head>
<!-- Page Preloder -->
{{-- <div id="preloder">
    <div class="loader"></div>
</div> --}}

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="{{route('browse_mangas')}}">
                            <img src="img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="{{route('browse_mangas')}}">Accueil</a></li>
                                <li><a>Mangas<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">

                                        @foreach($listMangasName as $manga)
                                        <?php dd($manga['id']); ?>
                                            <li><a href="{{route('browse_tomes', ['id' => $manga['id']) }}">{{$manga['name']}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="">Actus</a></li>
                                {{-- <li><a href="#">Contacts</a></li> --}}
                                {{-- <a href="#" class="search-switch"><span class="icon_search"></span></a> --}}
                                <li><a>Mon Espace<span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        @if (!Auth::check())
                                        <li><a href="{{route('login')}}">Connexion</a></li>
                                            <li><a href="{{route('register')}}">Inscription</a></li>
                                        @else
                                        <li>
                                            <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                {{ __('Deconnexion') }}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            @endif
                                        </li>
                                        
                                        @if (Auth::check())
                                        <li><a href="{{route('admin_browse_mangas')}}">Gestion Manga</a></li>
                                        <li><a href="{{route('admin_browse_tomes')}}">Gestion Tome</a></li>
                                        <li><a href="">Gestion des utilisateur</a></li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->
<body>
    <!-- wrap -->
    @include('layouts/flash-message')
    <div class="wrapper">  

    @yield('contenu')
    </div>


</body>
@include('layouts/footer')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<!-- Js Plugins -->
<script src="<?= asset('assets/js/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= asset('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= asset('assets/js/player.js') ?>"></script>
<script src="<?= asset('assets/js/jquery.nice-select.min.js') ?>"></script>
<script src="<?= asset('assets/js/mixitup.min.js') ?>"></script>
<script src="<?= asset('assets/js/jquery.slicknav.js') ?>"></script>
<script src="<?= asset('assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= asset('assets/js/main.js') ?>"></script>
</html>