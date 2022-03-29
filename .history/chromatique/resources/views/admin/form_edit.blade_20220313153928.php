@extends ('layout')

@section('contenu')
<div class="container">
  <div class="row">
    <h3 class="col-8 text-white">Modification du Manga {{$manga->manga_name}} </h3>
    <form method="post" action="{{route('admin_edit_manga', [ 'id'=> $manga->id ])}}" enctype="multipart/form-data" class="col-8 align-self-center">
      {{csrf_field()}}
        <div class="">
          <label class="text-white" for="mangaCover">Couverture du Manga :</label>
          <img class="card" src="<?= asset('storage/mangas/') ?>{{$manga->manga_directory .'/'. $manga->manga_cover }}" alt="{{$manga->manga_cover}}">
          <input type="file" name="mangaCover" class="myfrm form-control" value="{{$manga->manga_cover}}">
        </div>

        <div class="">
          <label class="text-white" for="mangaBanner">Banniere de la page du manga : </label>
          <img class="card" src="<?= asset('storage/mangas/') ?>{{$manga->manga_directory . $manga->manga_banner }}" alt="{{$manga->manga_banner}}">
          <input type="file" name="mangaBanner" class="myfrm form-control" value="{{$manga->manga_banner}}">
        </div>

        <div class="" >
          <label class="text-white" for="mangaName">Nom du Manga</label>
          <input class="form-control" type="text" name="mangaName" id="mangaName" value="{{$manga->manga_name}}">
        </div>

        <div class="form-group" >
          <label class="text-white" for="author">Autheur</label>
          <input class="form-control" type="text" name="author" id="author" value="{{$manga->manga_author}}">
        </div>

        <div class="form-group" >
          <label class="text-white" for="synopsis">Synopsis</label>
          <input class="form-control" type="textarea" name="synopsis" id="synopsis" value="{{$manga->manga_synopsis}}">
        </div>
        {{-- <div class="form-group" >
          <label class="text-white" for="uploaderId">Uploader</label>
        
          <select class="form-control" name="uploaderId" id="uploaderId">
            <option value="">--Choisir un uploader--</option>
              @foreach ($uploaderList as $uploader)
                <option value="{{$uploader->id}}">{{$uploader->name}}</option>
              @endforeach
          </select>
        </div> --}}

        <button type="submit" class="btn btn-success" style="margin-top:10px">Modifier</button>
    </form>        
    
</div>

<script type="text/javascript" src="{{ URL::asset('assets/js/flash-message.js') }}"></script>
@endsection

