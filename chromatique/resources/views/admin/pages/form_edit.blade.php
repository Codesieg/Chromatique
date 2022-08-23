@extends ('layout')

@section('contenu')
<div class="container">
  <h3 class="col-8 text-white">Modification du Tome {{ $tome->tome_number }} de {{ $mangaName->manga_name }}</h3>
  <div class="d-flex justify-content-between mb-3 px-3">
    <button type="button" class="btn btn-orange btn-sm white"><a href="{{route('admin_read_tome', [ 'id'=> $tome->id ])}}"><i class="fa fa-angle-double-left white"></i></a></button>
  </div>
  <form method="patch" action="{{route('admin_add_tome')}}" enctype="multipart/form-data" class="col-8 align-self-center">
    @csrf
    @method('PATCH')
      <div class="">
        <label class="text-white" for="tomePath">Couverture du tome</label>
        <input type="file" name="tomePath" class="myfrm form-control">
      </div>

      <div class="form-group" >
        <label class="text-white" for="tomeNumber">Numero du tome</label>
        <input class="form-control" type="text" name="tomeNumber" id="tomeNumber" value="{{ $tome->tome_number }}">
      </div>

      <div class="form-group" >
        <label class="text-white" for="mangaId">Manga</label>
          <select class="form-control" name="mangaId" id="mangaId">
            <option value="{{$mangaName->id}}">{{$mangaName->manga_name}}</option>
          </select>
    </div>
      <button type="submit" class="btn btn-success" style="margin-top:10px">Modifier</button>
  </form>        

  
</div>
@endsection