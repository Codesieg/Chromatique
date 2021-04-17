<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chromatique</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    
    <link rel="stylesheet" href="<?= __DIR__ . 'assets/css/style.css' ?>">
    <link rel="stylesheet" href="assets/css/menu.css">
</head>

<header>
    <div class="infos-menu">
        <div class="wrapper-menu">
            <img id="logo" src='assets/img/logo.png' alt="logo">
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
</html>