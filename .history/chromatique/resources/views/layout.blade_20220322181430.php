<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
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
<!-- <div id="preloder">
    <div class="loader"></div>
</div> -->

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
                    {{dump(Auth::check())}}
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="{{route('browse_mangas')}}">Accueil</a></li>
                                <li> <span class="arrow_carrot-down"></span> Mangas </a>
                                    <ul class="dropdown">
                                        <li><a href="categories.html">Naruto</a></li>
                                        <li><a href="anime-details.html">Bleach</a></li>
                                        <li><a href="anime-watching.html">Alice in Borderland</a></li>
                                        <li><a href="blog-details.html">One Piece</a></li>
                                        <li><a href="signup.html">Death Note</a></li>
                                        <li><a href="login.html">Dragon Ball</a></li>
                                    </ul>
                                </li>
                                <li><a href="./blog.html">Actus</a></li>
                                <li><a href="#">Contacts</a></li>
                                <a href="#" class="search-switch me-4"><span class="icon_search"></span></a>
                                <span class="icon_profile"></span>
                                <ul class="dropdown">
                                    @if (!Auth::check())
                                    <li><a href="{{route('login')}}">Connexion</a></li>
                                        <li><a href="{{route('register')}}">Inscription</a></li>
                                    @else
                                    <li><a href="">Deconnexion</a></li>
                                    @endif
                                    
                                    @if (Auth::check())
                                    <li><a href="{{route('admin_browse_mangas')}}">Ajouter Manga</a></li>
                                    <li><a href="{{route('admin_browse_tomes')}}">Ajouter Tome</a></li>
                                    <li><a href="">Gestion des utilisateur</a></li>
                                    @endif
                                </ul>
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

@yield('footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>