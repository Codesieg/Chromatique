@extends ('layout')

@section('contenu')

<div class="container">
    <div class="menu_admin">
        <div class="add">
            {{-- <button type="button" class="btn btn-primary btn-sm"><a class="text-decoration-none text-white" href="{{route('admin_form_tome', ['id' => $manga->id]) }}">Ajouter Tome</a></button> --}}
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
            @foreach ($listTomes as $tome)
            <tr>
                <td class="text-white">{{$tome->id}}</td>
                <td class="text-white">{{$tome->tome_name}}</td>
                <td class="text-white">{{$tome->created_at}}</td>
                <td class="text-white">{{$tome->update_at}}</td>
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
                        <a class="text-decoration-none text-white" href="{{route('admin_form_tome', ['id' => $manga->id]) }}">Ajouter Tome</a>
                    </button>
                    
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection