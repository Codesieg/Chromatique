@extends ('layout')

@section('contenu')
<div class="container">
    <h3 class="m-3 text-white">Ajout d'un nouveau Manga</h3>
    <div class="d-flex justify-content-between mb-3 px-3">
      <button type="button" class="btn btn-orange btn-sm white"><a href="{{route('admin_browse_mangas')}}"><i class="fa fa-angle-double-left white"></i></a></button>
    </div>
    <form method="post" action="{{route('admin_add_manga')}}" enctype="multipart/form-data" class="col-8 align-self-center">
      {{csrf_field()}}
        <div class="">
          <label class="text-white" for="mangaCover">Couverture du Manga</label>
          <input type="file" name="mangaCover" class="myfrm form-control">
        </div>

        <div class="">
          <label class="text-white" for="mangaCover">Banniere du Manga</label>
          <input type="file" name="mangaBanner" class="myfrm form-control">
        </div>

        <div class="" >
          <label class="text-white" for="mangaName">Nom du Manga</label>
          <input class="form-control" type="text" name="mangaName" id="mangaName">
        </div>

        <div class="form-group" >
          <label class="text-white" for="author">Auteur</label>
          <input class="form-control" type="text" name="author" id="author">
        </div>

        <div class="form-group" >
          <label class="text-white" for="coloredBy">Colorisé par :</label>
          <select name="coloredBy" id="coloredBy">
                <option option value="">-- Choisir un utilisateur --</option>
              @foreach ($listUsers as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
              @endforeach
          </select>
        </div>

        <div class="form-group" >
          <label class="text-white" for="synopsis">Synopsis</label>
          <input class="form-control" type="text" name="synopsis" id="synopsis">
        </div>
        <button type="submit" class="btn btn-success" style="margin-top:10px">Ajouter</button>
    </form>        
    <div class="row">
      <span class="col-8 mt-2 text-white">Ajout automatique depuis répertoire manga du serveur :</span>
      <form method="post" action="{{route('admin_insert_manga')}}" enctype="multipart/form-data" class="col-8 align-self-center">
        {{csrf_field()}}
        <button type="submit" class="btn btn-success" style="margin-top:10px">Scanner</button>
      </form>   
    </div>
</div>

<script type="text/javascript" src="{{ URL::asset('assets/js/flash-message.js') }}"></script>
@endsection

