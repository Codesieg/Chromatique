@extends ('admin/layout')

@section('contenu')
<div class="container">
  {{ csrf_field() }}
  <form action="/inscription" method="post">
    <input type="text" name="email" placeholder="Email">
    <input type="textarea" name="password" placeholder="Mot de passe">
    <input type="password" name="password_confirmation" placeholder="Mot de passe (confirmation)">
    <input type="submit" value="M'inscrire">
</form>
  <button type="button" class="btn btn-primary btn-sm"><a text-decoration-none text-white" href="{{route('admin_form_manga',)}}">Ajouter</a></button>
  
</div>
@endsection