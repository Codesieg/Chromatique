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
                    @foreach ($listPages as $page)
                        <a href="{{$page->id}}">
                            <div class="card">
                                <img class="cover" src="<?= asset('assets/mangas/')?>{{$page->page_jacket}}" alt="">
                                <h1 class="white">{{$page->page_name}}</h1>
                            </div>
                        </a>
                    @endforeach     
            </section>
        </div>
    @endsection

@endsection