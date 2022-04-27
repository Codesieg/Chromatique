@extends ('layout')

@section('contenu')

<div class="container">
    <div class="row">
        <button type="button" class="btn btn-primary btn-sm align-self-end white"><a class="text-decoration-none text-white" href="{{route('admin_form_manga')}}"><i class="fa fa-plus-square white"></i></a></button>    
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
                        <a class="text-decoration-none text-white"  href="{{route('admin_form_edit_manga', ['id' => $manga->id]) }}" data-toggle="tooltip" data-placement="bottom" title="Modifier le manga"><i class="fa fa-edit white"></i></a>
                    </button>
                    
                    <button type="button" class="btn btn-success btn-sm text-decoration-none text-white">
                        <a class="text-decoration-none text-white" href="{{route('admin_read_tome', ['id' => $manga->id]) }}" data-toggle="tooltip" data-placement="bottom" title="Voir les tomes"><i class="fa fa-eye white"></i></a>
                    </button>
                    
                    <button type="submit" class="btn btn-danger btn-sm text-decoration-none text-white">
                    <form action="{{route('admin_delete_manga', ['id' => $manga->id])}}" method="post">
                            <i class="fa fa-trash"></i>
                            <input type="hidden" name="_method" value="delete" />
                            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                            @csrf
                        </button> 
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection