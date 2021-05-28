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
            <section class="cards">
                    @foreach ($listTomes as $tome)
                   {{ dd($tome)}}
                    {{-- ici j'ai besoin du chapters_id --}}
                        <a href="page/{{$tome->id}}"> 
                            <div class="card">
                            
                                    <img class="cover" src="<?= asset('assets/mangas/')?>{{$tome->manga_directory . $tome->tome_path}}" alt="">
                    
                                <h1 class="white">{{$tome->tome_name}}</h1>
                            </div>
                        </a>
                    @endforeach     
            </section>
        </div>
    @endsection

@endsection