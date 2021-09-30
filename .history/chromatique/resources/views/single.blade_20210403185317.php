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
            <section class="cards">
                    @foreach ($listMangas as $manga)
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

@endsection