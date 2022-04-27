@extends ('layout')

@section('contenu')

    <!-- wrap -->
    <main class="main">
        <div class="content">
            <div class="zoom">
                <i class="zoom-in fas fa-search-plus white"></i>
                <i class="zoom-out fas fa-search-minus white"></i>
            </div>
            @foreach ($listPages as $page)
                <div class="page">
                    <img class="scale" src="<?= asset('storage/mangas/')?>{{ '/' . $page->page_file}}" alt="">
                </div>
                </a>
            @endforeach     
        </div>
        <script type="text/javascript" src="{{ URL::asset('assets/js/zoom.js') }}"></script>

@endsection