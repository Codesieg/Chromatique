@extends ('layout')

@section('contenu')

<div class="container">
    <h2 class="white m-3">Liste des tomes de {{$mangaName->manga_name}}</h2>
    <div class="d-flex justify-content-end mb-3 px-3">
        <div class="add">
            <button type="button" class="btn btn-primary btn-sm white"><a href="{{route('admin_form_tome', ['id' => $mangaName->id]) }}"><i class="fa fa-plus-square white"></i></a></button>
        </div>
        
    </div>
    
    <div class="col-12">
        <table class="table">
            <thead>
            <tr>
                {{-- <th class="text-white">Id</th> --}}
                <th class="text-white">Nom</th>
                <th class="text-white">Aperçu</th>
                <th class="text-white">CreatedAt</th>
                <th class="text-white">UpdateAt</th>
                <th class="text-white">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($listTomes as $tome)
            <tr>
                {{-- <td class="text-white">{{$tome->id}}</td> --}}
                <td class="text-white">Tome {{$tome->tome_number}}</td>
                <td class="text-white manga-thumb"><img class="manga-thumb" src="<?= asset('assets/mangas/')?>{{$mangaName->manga_directory . $tome->tome_path}}" alt=""></td>
                <td class="text-white">{{$tome->created_at}}</td>
                <td class="text-white">{{$tome->updated_at}}</td>
                <td>
                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white" href="{{route('admin_edit_tome', ['id' => $tome->id]) }}">Modifier</a>
                    </button>
                    
                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white" href="{{route('admin_read_tome', ['id' => $tome->id]) }}">Voir Tome</a>

                    </button>
                        <form action="{{route('admin_delete_tome', ['id' => $tome->id])}}" method="post">
                            <input class="btn-sm btn-danger" type="submit" value="Supprimer">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection