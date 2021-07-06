@extends ('layout')

@section('contenu')

    <div class="content">
        <section class="cards">
                @foreach ($listMangas as $manga)
                    <a href="tome/{{$manga->id}}">
                        <div class="card">
                            <img class="cover" src="<?= asset('assets/mangas/') ?>{{$manga->manga_directory . $manga->manga_cover}}" alt="">
                            <div class="main-text">
                                <h1 class="white title">{{$manga->manga_name}}</h1>
                                <p><?= substr($manga->manga_synopsis, 0, 100) ?>...</p>
                            </div>
                        </div>
                    </a>
                @endforeach     
        </section>
    </div>
@endsection
<!-- content-->

