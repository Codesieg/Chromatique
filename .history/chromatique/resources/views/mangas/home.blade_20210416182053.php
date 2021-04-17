@extends ('layout')

@section('contenu')

    <div class="content">
        <?php dump($listMangas); ?>
        <section class="cards">
                @foreach ($listMangas as $manga)
                
                    <a href="tome/{{$manga->id}}">
                        <div class="card">
                            <img class="cover" src="<?= asset('assets/mangas/') ?>{{$manga->manga_jacket}}" alt="">
                            <h1 class="white">{{$manga->manga_name}}</h1>
                        </div>
                    </a>
                @endforeach     
        </section>
    </div>
@endsection
<!-- content-->
