@extends ('layout')

@section('contenu')

    <!-- wrap -->
    {{-- <main class="main"> --}}
        <div class="banner">
        </div>
        <div class="details">
            <div class="details-main-cover">
                <img class="details-manga-cover" src="<?= asset('assets/mangas/') ?>/One_Piece/one_piece.jpg" alt="">
            </div>
            <div class="details-infos">
                <h1 class="details-infos-title white">One Piece</h1>
                <p>de Eiichirō Oda </p>
                <p class="deatils-infos-synopsys">Luffy, un jeune garçon, rêve de devenir le Roi des Pirates en trouvant le One Piece, le trésor ultime rassemblé par Gol D. Roger, le seul pirate à avoir jamais porté le titre de Roi des Pirates. Shanks le Roux, un pirate qui est hébergé par les villageois du village de Luffy, est le modèle de Luffy depuis que le pirate a sauvé la vie du garçon. Un jour, Luffy mange un des fruits du démon, qui était détenu par l'équipage de Shanks, ce qui fait de lui un homme-caoutchouc, pouvant étirer son corps à volonté. À son départ, Shanks donne à Luffy son chapeau de paille. Luffy ne doit lui rendre ce chapeau que lorsqu'il sera devenu un fier pirate</p>
                <p class="details-infos-uploader">Uploader : Sieg heart</p>
            </div>
        </div>
        <div class="content">
            <section class="cards">
                    @foreach ($listTomes as $tome)
                        <a href="page/{{ $tome->id }}"> 
                            <div class="card">
                                    <img class="cover" src="<?= asset('assets/mangas/') ?>{{ $tome->manga_directory . $tome->tome_path }}" alt="">
                                    <div class="main-text main-text--bottom">
                                        <h1 class="white title">Tome {{ $tome->tome_number }}</h1>
                                    </div>
                            </div>

                        </a>
                    @endforeach     
            </section>
        </div>
    @endsection
