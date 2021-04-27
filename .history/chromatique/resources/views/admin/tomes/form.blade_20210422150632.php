@extends ('layout')

@section('contenu')
<div class="container">
  <div class="row">
  <h3 class="col-8 text-white">Ajout d'un nouveau Tome</h3>
  <form method="post" action="{{route('admin_add_tome')}}" enctype="multipart/form-data" class="col-8 align-self-center">
    {{csrf_field()}}
      <div class="">
        <label class="text-white" for="tomeJacket">Couverture du tome</label>
        <input type="file" name="tomeJacket" class="myfrm form-control">
      </div>

      <div class="" >
        <label class="text-white" for="tomeName">Nom du tome</label>
        <input class="form-control" type="text" name="tomeName" id="tomeName">
      </div>

      <div class="form-group" >
        <label class="text-white" for="tomeNumber">Numero du tome</label>
        <input class="form-control" type="text" name="tomeNumber" id="tomeNumber">
      </div>

      <select class="form-control" name="mangaDirectory" id="mangaDirectory">
        <option value="">--Choisir un Manga--</option>
        @foreach ($mangasLists as $manga)
        <option value="{{$manga->manga_directory}}">{{$manga->manga_name}}</option>
        @endforeach
    </select>
    </div>

      <button type="submit" class="btn btn-success" style="margin-top:10px">Ajouter</button>
  </form>        
  </div>
  
</div>
@endsection