@extends ('layout')

@section('contenu')
<?php dump($listMangas); ?>
    <div class="content">
        <section class="cards">
                @foreach ($listMangas as $manga)
                    <a href="{{$manga['id']}}">
                        <div class="card">
                            <img class="cover" src="assets/img/{{$manga['image']}}" alt="">
                            <h1 class="white">{{$manga['name']}}</h1>
                        </div>
                    </a>
                @endforeach     
        </section>
    </div>
@endsection
<!-- content-->
