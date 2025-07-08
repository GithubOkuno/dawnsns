@extends('layouts.logout')

@section('content')

<form method="POST" action="/register" class="form-container">
  @csrf

<h2>新規ユーザー登録</h2>
<ol>
@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach
</ol>

<label for="ユーザー名" class="form-label">ユーザー名</label>
<input class="input" name="username" type="text">

<label for="メールアドレス" class="form-label">メールアドレス</label>
<input class="input" name="mail" type="text">

<label for="パスワード" class="form-label">パスワード</label>
<input class="input" name="password" type="text">

<label for="パスワード確認" class="form-label">パスワード確認</label>
<input class="input" name="password-confirm" type="text">

<input type="submit" value="登録" class="button-submit">

<p><a href="/login">ログイン画面へ戻る</a></p>

</form>

@endsection
