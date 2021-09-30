@extends ('layout');

@section('contenu')

    <!-- wrap -->
    <main class="main">
        <div class="search">
            <fieldset class="field-container">
                <input type="text" placeholder="Search..." class="st-default-search-input field" />
                <div class="icons-container">
                    <div class="icon-search"></div>
                </div>
            </fieldset>
            
        </div>
        @section('contenu')

        <div class="content">
            <?php dump($listTomes); ?>
            <section class="cards">
                    @foreach ($listTomes as $tome)
                    
                        <a href="{{$tome->id}}">
                            <div class="card">
                                <img class="cover" src="assets/mangas/{{$manga->tome_jacket}}" alt="">
                                <h1 class="white">{{$tome->tome_name}}</h1>
                            </div>
                        </a>
                    @endforeach     
            </section>
        </div>
    @endsection

@endsection