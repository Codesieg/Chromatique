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
                <td class="text-white">{{$tome->tome_jacket}}</td>
                <td class="text-white">{{$tome->created_at}}</td>
                <td class="text-white">{{$tome->updated_at}}</td>
                <td>
                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white"  href="">Modifier</a>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm text-decoration-none text-white">
                        <form action="{{route('admin_delete_tome', ['id' => $tome->id])}}" method="post">
                            <input class="btn btn-danger" type="submit" value="Supprimer">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </button> 

                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white" href="{{route('admin_read_tome', ['id' => $tome->id]) }}">Voir Tome</a>
                    </button>
                    TODO{{--  créer la route et la requêtes pour afficher toutes es pages d'un tome --}}
                    
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection