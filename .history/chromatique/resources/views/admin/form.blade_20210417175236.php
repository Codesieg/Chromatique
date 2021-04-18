@extends ('admin/layout')

@section('contenu')
<div class="container ">
  <div class="">
  <h3 class="well">Ajout d'un nouveau Tome</h3>
  <form method="post" action="{{route('admin_add_manga')}}" enctype="multipart/form-data" class="col-8">
    {{csrf_field()}}
      <div class="input-group hdtuto control-group lst increment" >
        <label for="mangaJacket">Couverture du Tome</label>
        <input type="file" name="filenames[]" class="myfrm form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Ajouter</button>
        </div>
      </div>

      <div class="form-group row" >
        <label class="col-sm-2 col-form-label" for="mangaName">Nom du Manga</label>
        <input class="form-control" type="text" name="mangaName" id="mangaName">
      </div>

      <div class="form-group row" >
        <label class="col-sm-2 col-form-label" for="author">Autheur</label>
        <input class="form-control" type="text" name="author" id="author">
      </div>

      <div class="form-group row" >
        <label class="col-sm-2 col-form-label" for="synopsis">Synopis</label>
        <input class="form-control" type="text" name="synopsis" id="synopsis">
      </div>

      <div class="form-group" >
        <label for="userId">Uploader</label>
      
        <select class="form-control" name="userId" id="userId">
          <option value="">--Choisir un uploader--</option>
          @foreach ($uploaderList as $uploader)
          dump()
          <option value="{{$uploader->id}}">{{$uploader->pseudo}}</option>
          @endforeach
      </select>
      </div>

      <button type="submit" class="btn btn-success" style="margin-top:10px">Ajouter</button>
  </form>        
  </div>
  
</div>
@endsection