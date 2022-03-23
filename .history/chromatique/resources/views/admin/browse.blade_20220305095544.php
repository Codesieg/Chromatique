@extends ('layout')

@section('contenu')

<div class="container">
    <div class="menu_admin">
        <div class="add">
            <button type="button" class="btn btn-primary btn-sm"><a class="text-decoration-none text-white" href="{{route('admin_form_manga')}}">Ajouter Manga</a></button>
        </div>
        
    </div>
    
    <div class="col-12">
        <table class="table">
            <thead>
            <tr>
                <th class="text-white">Id</th>
                <th class="text-white">Nom</th>
                <th class="text-white">CreatedAt</th>
                <th class="text-white">UpdateAt</th>
                <th class="text-white">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($listMangas as $manga)
            <tr>
                <td class="text-white">{{$manga->id}}</td>
                <td class="text-white">{{$manga->manga_name}}</td>
                <td class="text-white">{{$manga->created_at}}</td>
                <td class="text-white">{{$manga->update_at}}</td>
                <td>
                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white"  href="{{route('admin_read_tome', ['id' => $manga->id]) }}">Modifier</a>
                    </button>
                    
                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white" href="{{route('admin_read_tome', ['id' => $manga->id]) }}">Voir Tomes</a>
                    </button>
                    
                    <button type="button" class="btn btn-danger btn-sm text-decoration-none text-white">
                        <form action="{{route('admin_delete_manga', ['id' => $manga->id])}}" method="post">
                            <input class="btn btn-danger" type="submit" value="Supprimer">
                            <input type="hidden" name="_method" value="delete" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </button> 
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection