@extends ('layout')

@section('contenu')

    <div class="content">
        <section class="cards">
                @foreach ($listMangas as $manga)
                <?php dump($listMangas); ?>
                    <a href="{{$manga->manga_name}}">
                        <div class="card">
                            <img class="cover" src="assets/mangas/{{$manga->manga_jacket}}" alt="">
                            <h1 class="white">{{$manga->manga_name}}</h1>
                        </div>
                    </a>
                @endforeach     
        </section>
    </div>
@endsection
<!-- content-->
