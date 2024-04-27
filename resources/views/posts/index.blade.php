@extends('layouts.login')

@section('content')
<form action="http://127.0.0.1:8000/create" method="post">
  @csrf
  <div>
    <input type="text" name="newPost" placeholder="何をつぶやこうか…？">
  </div>
<div class="button">
  <button type="submit">後で画像？に変える</button>
</div>
</form>

@endsection
