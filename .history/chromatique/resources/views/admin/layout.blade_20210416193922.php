<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chromatique</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
</head>

<header>
    <div class="infos-menu">
        <div class="wrapper-menu">
            <img id="logo" src="<?= asset('assets/img/logo.png') ?>" alt="logo">
            <a href="https://discord.gg/3HH8Usj"><i class="lab la-3x la-discord white"></i></a>
            <a href="#"><i class="lab la-3x la-telegram white"></i></a>
            <a href="#"><i class="las la-3x la-info-circle white"></i></a>
        </div>
    </div>
</header>
<body>
    <!-- wrap -->
<main class="main">
    @yield('contenu')
</main>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</html>