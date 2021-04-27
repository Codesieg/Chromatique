@extends ('layout')

@section('contenu')

<div class="container">
    <h1>Liste des tomes de {{$mangaName->manga_name}}</h1>
    <div>
        <div class="add">
            {{-- <button type="button" class="btn btn-primary btn-sm"><a class="text-decoration-none text-white" href="{{route('admin_form_tome', ['id' => $mangaName->id]) }}">Ajouter Tome</a></button> --}}
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
                <td class="text-white">{{$tome->tome_name}}</td>
                <td class="text-white manga-thumb"><img class="manga-thumb" src="<?= asset('assets/mangas/')?>{{$mangaName->manga_directory . $tome->tome_jacket}}" alt=""></td>
                <td class="text-white">{{$tome->created_at}}</td>
                <td class="text-white">{{$tome->updated_at}}</td>
                <td>
                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white"  href="">Modifier</a>
                    </button>
                    
                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white" href="{{route('admin_read_tome', ['id' => $tome->id]) }}">Voir Tome</a>
                    </button>
                        <form class="form-delete" action="{{route('admin_delete_tome', ['id' => $tome->id])}}" method="post">
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