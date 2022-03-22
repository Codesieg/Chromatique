@extends ('layout')

@section('contenu')
<div class="container">
  <div class="row">
    <h3 class="col-8 text-white">Ajout d'un nouveau Manga</h3>
    <form method="post" action="{{route('admin_add_manga')}}" enctype="multipart/form-data" class="col-8 align-self-center">
      {{csrf_field()}}
        <div class="">
          <label class="text-white" for="mangaCover">Couverture du Manga</label>
          <input type="file" name="mangaCover" class="myfrm form-control">
        </div>

        <div class="" >
          <label class="text-white" for="mangaName">Nom du Manga</label>
          <input class="form-control" type="text" name="mangaName" id="mangaName">
        </div>

        <div class="form-group" >
          <label class="text-white" for="author">Autheur</label>
          <input class="form-control" type="text" name="author" id="author">
        </div>

        <div class="form-group" >
          <label class="text-white" for="synopsis">Synopsis</label>
          <input class="form-control" type="text" name="synopsis" id="synopsis">
        </div>

        <div class="form-group" >
          <label class="text-white" for="uploaderId">Uploader</label>
        
          <select class="form-control" name="uploaderId" id="uploaderId">
            <option value="">--Choisir un uploader--</option>
              @foreach ($uploaderList as $uploader)
                <option value="{{$uploader->id}}">{{$uploader->name}}</option>
              @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-success" style="margin-top:10px">Ajouter</button>
    </form>        
    <div class="row">
      <h3 class="col-8 text-white">Ajout automatique depuis dossier publique</h3>
      <form method="post" action="{{route('admin_insert_manga')}}" enctype="multipart/form-data" class="col-8 align-self-center">
        {{csrf_field()}}
        <button type="submit" class="btn btn-success" style="margin-top:10px">Scanner</button>
      </form>   
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('assets/js/flash-message.js') }}"></script>
@endsection

