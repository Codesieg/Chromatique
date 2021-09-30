@extends ('layout')

@section('contenu')

    <!-- wrap -->
    <main class="main">
        <div class="content">
            <div class="zoom">
                <i class="zoom-in las la-2x la-search-plus white"></i>
                <i class="zoom-out las la-2x la-search-minus white"></i>
            </div>
            @foreach ($listPages as $page)
                <div class="page">
                    <img class="scale" src="<?= asset('assets/mangas/')?>{{$page->page_file}}" alt="">
                </div>
                </a>
            @endforeach     
        </div>
        <script type="text/javascript" src="{{ URL::asset('assets/js/zoom.js') }}"></script>

@endsection