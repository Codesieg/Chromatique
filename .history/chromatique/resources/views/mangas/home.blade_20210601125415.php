@extends ('layout')

@section('contenu')

    <div class="content">
        <section class="cards">
                @foreach ($listMangas as $manga)
                    <a href="tome/{{$manga->id}}">
                        <div class="card">
                            <img class="cover" src="<?= asset('assets/mangas/') ?>{{$manga->manga_directory . $manga->manga_cover}}" alt="">
                            <h1 class="white main-text">{{$manga->manga_name}}</h1>
                        </div>
                    </a>
                @endforeach     
        </section>
    </div>
@endsection
<!-- content-->

