@extends ('admin/layout')

@section('contenu')
<div class="add">
   <button type="button" class="btn btn-primary btn-sm"><a class="text-decoration-none text-white" href="{{route('admin_add_manga')}}">Ajouter</a></button> 
</div>

<div class="list">
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
                <button type="button" class="btn btn-danger btn-sm text-decoration-none text-white"><a class="text-decoration-none text-white" href="">Supprimer</a></button>
                <button type="button" class="btn btn-success btn-sm text-decoration-none text-white"><a class="text-decoration-none text-white"  href="">Modifier</a></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
  @endsection