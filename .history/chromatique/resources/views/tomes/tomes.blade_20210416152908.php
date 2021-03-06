@extends ('layout')

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
                   
                    
                        <a href="{{$listTomes->id}}">
                            <div class="card">
                                <img class="cover" src="assets/mangas/{{$listTomes->tome_jacket}}" alt="">
                                <h1 class="white">{{$listTomes->tome_name}}</h1>
                            </div>
                        </a>
                      
            </section>
        </div>
    @endsection

@endsection