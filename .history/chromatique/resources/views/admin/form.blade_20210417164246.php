@extends ('admin/layout')

@section('contenu')
<div class="container">
  @if (count($errors) > 0)
  <div class="alert alert-danger">
      <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
  </div>
  @endif
  
  
  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div> 
  @endif
  
  
  <h3 class="well">Ajout d'un nouveau Tome</h3>
  <form method="post" action="{{route('admin_add_manga')}}" enctype="multipart/form-data">
    {{csrf_field()}}
  
  
      <div class="input-group hdtuto control-group lst increment" >
        <input type="file" name="filenames[]" class="myfrm form-control">
        <div class="input-group-btn"> 
          <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Ajouter</button>
        </div>
      </div>
      <div class="clone hide">
        <div class="hdtuto control-group lst input-group" style="margin-top:10px">
          <input type="file" name="filenames[]" class="myfrm form-control">
          <div class="input-group-btn"> 
            <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
          </div>
        </div>
      </div>

      <div>
        <label for="mangaJacket">Couverture du Tome</label>
        <input type="text" name="mangaJacket" id="mangaJacket">
      </div>

      <div>
        <label for="author">Couverture du Tome</label>
        <input type="text" name="author" id="author">
      </div>

      <div>
        <label for="synopsis">Couverture du Tome</label>
        <input type="textarea" name="synopsis" id="synopsis">
      </div>

      <div>
        <label for="userId">Couverture du Tome</label>
        <input type="select" name="userId" id="userId">
      </div>

      
  
  
      <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
  
  
  </form>        
  </div>
  
  
  <script type="text/javascript">
      $(document).ready(function() {
        $(".btn-success").click(function(){ 
            var lsthmtl = $(".clone").html();
            $(".increment").after(lsthmtl);
        });
        $("body").on("click",".btn-danger",function(){ 
            $(this).parents(".hdtuto control-group lst").remove();
        });
      });
  </script>
  
  <button type="button" class="btn btn-primary btn-sm"><a text-decoration-none text-white" href="{{route('admin_form_manga',)}}">Ajouter</a></button>
  
</div>
@endsection