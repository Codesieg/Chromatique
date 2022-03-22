@extends ('layout')

@section('contenu')

    <div class="content">
        <section class="cards">
                @foreach ($listMangas as $manga)
                    <a href="/tome/browse/{{$manga->id}}">
                        <div class="card">
                            <img class="cover" src="http://127.0.0.1:8000/storage/app/public/mangas/demon_slayer/Demon_Slayer.jpg" alt="">
                            <div class="main-text">
                                <h1 class="white title">{{$manga->manga_name}}</h1>
                                <p class="synopsis"><?= substr($manga->manga_synopsis, 0, 100) ?>...</p>
                                <button type="button" class="btn btn-primary btn-sm mt-2 end-0"> Lire le Manga</button>
                            </div>
                        </div>
                    </a>
                @endforeach     
        </section>
    </div>
@endsection
<!-- content-->

