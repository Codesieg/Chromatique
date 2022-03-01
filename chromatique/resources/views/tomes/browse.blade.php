@extends ('layout')

@section('contenu')

    <!-- wrap -->
    {{-- <main class="main"> --}}
        <div class="banner">
        </div>
        <div class="details">
            <div class="details-main-cover">
                <img class="details-manga-cover" src="<?= asset('assets/mangas/') ?>{{$mangaDetails->manga_directory . $mangaDetails->manga_cover }}" alt="">
            </div>
            <div class="details-infos">
                <h1 class="details-infos-title white">{{ $mangaDetails->manga_name }}</h1>
                <p>de {{ $mangaDetails->manga_author }}</p>
                <p class="deatils-infos-synopsys">{{ $mangaDetails->manga_synopsis }}</p>
                {{-- <p class="details-infos-uploader">Uploader : {{ $uploader->name }}</p> --}}
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
                                        {{-- <i class="las la-download"></i> --}}
                                    </div>
                            </div>
                        </a>
                    @endforeach     
            </section>
        </div>
    @endsection
