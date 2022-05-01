@extends ('layout')

@section('contenu')

<div class="container">
    <h2 class="white m-3">Liste des pages du tome {{$tome->tome_number}} de {{$mangaName->manga_name}}</h2>
    <div class="d-flex justify-content-between mb-3 px-3">
            <button type="button" class="btn btn-orange btn-sm white"><a href="{{route('admin_browse_mangas')}}"><i class="fa fa-angle-double-left white"></i></a></button>
            <button type="button" class="btn btn-orange btn-sm white"><a href="{{route('admin_form_tome', ['id' => $mangaName->id]) }}"><i class="fa fa-plus-square white"></i></a></button>        
    </div>
    
    <div class="col-12">
        <table class="table">
            <thead>
            <tr>
                {{-- <th class="text-white">Id</th> --}}
                <th class="text-white">Url</th>
                <th class="text-white">Aperçu</th>
                <th class="text-white">CreatedAt</th>
                <th class="text-white">UpdateAt</th>
                <th class="text-white">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($listPages as $page)
            <tr>
                {{-- <td class="text-white">{{$tome->id}}</td> --}}
                <td class="text-white">{{$page->page_file}}</td>
                <td class="text-white manga-thumb"><img class="manga-thumb" src="<?= asset('assets/mangas/')?>{{$mangaName->manga_directory . $tome->tome_path}}" alt=""></td>
                <td class="text-white">{{$page->created_at}}</td>
                <td class="text-white">{{$page->updated_at}}</td>
                <td class="btn-actions">
                    {{-- <div class="d-flex">
                        <button type="button" class="btn btn-success btn-sm">
                            <a class="text-decoration-none text-white" href="{{route('admin_form_edit_page', ['id' => $page->id]) }}" data-toggle="tooltip" data-placement="bottom" title="Modifier le manga"><i class="fa fa-edit white"></i></a>
                        </button>
                        <button type="button" class="btn btn-success btn-sm mx-2">
                            <a class="text-decoration-none text-white" href="{{route('admin_read_page', ['id' => $page->id]) }}" data-toggle="tooltip" data-placement="bottom" title="Voir les pages"><i class="fa fa-eye white"></i></a>
                        </button>
                            <form action="{{route('admin_delete_page', ['id' => $page->id])}}" method="post">
                                <button type="submit" class="btn-trash">
                                    <i class="fa fa-trash white"></i>
                                    <input type="hidden" name="_method" value="delete" />
                                    @csrf
                                </button>
                            </form>
                    </div> --}}
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection