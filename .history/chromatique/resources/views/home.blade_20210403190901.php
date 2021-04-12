@extends ('layout')

@section('contenu')

    <div class="content">
        <section class="cards">
                @foreach ($listMangas as $manga)
                    <a href="{{$manga->manga_id}}">
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
