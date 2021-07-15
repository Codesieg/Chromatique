@extends ('layout')

@section('contenu')
<div class="container">
  <div class="row">
  <h3 class="col-8 text-white">Modification du Tome {{ $tome->tome_number }} de {{ $mangaName->$manga_name }}</h3>
  <form method="patch" action="{{route('admin_add_tome')}}" enctype="multipart/form-data" class="col-8 align-self-center">
    {{csrf_field()}}
      <div class="">
        <label class="text-white" for="tomePath">Couverture du tome</label>
        <input type="file" name="tomePath" class="myfrm form-control">
      </div>

      {{-- <div class="">
        <label class="text-white" for="pages">Pages du tome</label>
        <input type="file" name="pages[]" class="myfrm form-control" multiple="multiple">
      </div> --}}

      <div class="form-group" >
        <label class="text-white" for="tomeNumber">Numero du tome</label>
        <input class="form-control" type="text" name="tomeNumber" id="tomeNumber" value="{{ $tome->tome_number }}">
      </div>

      <div class="form-group" >
        <label class="text-white" for="mangaId">Manga</label>
          <select class="form-control" name="mangaId" id="mangaId">
              @foreach ($mangaLists as $manga)
            <option value="{{$manga->id}}">{{$manga->manga_name}}</option>
            @endforeach
          </select>
    </div>

      <button type="submit" class="btn btn-success" style="margin-top:10px">Modifier</button>
  </form>        
  </div>
  
</div>
@endsection