@extends ('admin/layout')

@section('contenu')
<div class="add">
   <button type="button" class="btn btn-primary btn-sm"><a href="{{route('admin_add_manga')}}">Ajouter</a></button> 
</div>

<div class="list">
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>CreatedAt</th>
            <th>UpdateAt</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($listMangas as $manga)
          <tr>
            <td>{{$manga->id}}</td>
            <td>{{$manga->manga_name}}</td>
            <td>{{$manga->created_at}}</td>
            <td></td>
            <td>{{$manga->update_at}}</td>
            <td>
                <button type="button" class="btn btn-danger btn-sm"><a href="">Supprimer</a></button>
                <button type="button" class="btn btn-success btn-sm"><a href="">Modifier</a></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
  @endsection