@extends ('layout')

@section('contenu')
<div class="container">
  <div class="row">
  <h3 class="col-8 text-white">Ajout d'un nouveau Tome</h3>
  <form method="post" action="{{route('admin_add_manga')}}" enctype="multipart/form-data" class="col-8 align-self-center">
    {{csrf_field()}}
      <div class="">
        <label class="text-white" for="mangaJacket">Couverture du tome</label>
        <input type="file" name="mangaJacket" class="myfrm form-control">
        {{-- <div class="input-group-btn"> 
          <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Ajouter</button>
        </div> --}}
      </div>

      <div class="" >
        <label class="text-white" for="tomeName">Nom du tome</label>
        <input class="form-control" type="text" name="tomeName" id="tomeName">
      </div>

      <div class="form-group" >
        <label class="text-white" for="tomeNumber">Numero du tome</label>
        <input class="form-control" type="text" name="tomeNumber" id="tomeNumber">
      </div>

      <div class="form-group" >
        <label class="text-white" for="tomeJacket">Couverture du tome</label>
        <input class="form-control" type="text" name="tomeJacket" id="tomeJacket">
      </div>

      <button type="submit" class="btn btn-success" style="margin-top:10px">Ajouter</button>
  </form>        
  </div>
  
</div>
@endsection