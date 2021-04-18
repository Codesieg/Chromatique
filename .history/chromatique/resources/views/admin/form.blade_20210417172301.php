@extends ('admin/layout')

@section('contenu')
<div class="container">
  
  <h3 class="well">Ajout d'un nouveau Tome</h3>
  <form method="post" action="{{route('admin_add_manga')}}" enctype="multipart/form-data">
    {{csrf_field()}}
      <div class="input-group hdtuto control-group lst increment" >
        <label for="mangaJacket">Couverture du Tome</label>
        <input type="file" name="filenames[]" class="myfrm form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Ajouter</button>
        </div>
      </div>
      <div>
        <label for="mangaName">Nom du Manga</label>
        <input type="text" name="mangaName" id="mangaName">
      </div>

      <div>
        <label for="author">Autheur</label>
        <input type="text" name="author" id="author">
      </div>

      <div>
        <label for="synopsis">Synopis</label>
        <input type="text" name="synopsis" id="synopsis">
      </div>

      <div>
        <label for="userId">Uploader</label>
      
        <select name="userId" id="userId">
          <option value="">--Choisir un uploader--</option>
          @foreach ($uploaderList as $key => $uploader)
          <option value="{{$key}}">{{$uploader->pseudo}}</option>
          @endforeach
      </select>
      </div>

      <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
  
  
  </form>        
  </div>
  
  <button type="button" class="btn btn-primary btn-sm"><a text-decoration-none text-white" href="{{route('admin_form_manga',)}}">Ajouter</a></button>
  
</div>
@endsection