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
            <div class="zoom">
                <i class="zoom-in las la-3x la-search-plus white"></i>
                <i class="zoom-out las la-3x la-search-minus white"></i>
            </div>
            @foreach ($listPages as $page)
                <div class="page">
                    <img class="scale" src="<?= asset('assets/mangas/')?>{{$page->page_file}}" alt="">
                </div>
                </a>
            @endforeach     
        </div>
    @endsection

@endsection