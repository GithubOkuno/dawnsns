@extends('layouts.logout')

@section('content')

<form method="POST" action="/login" class="form-container">
    @csrf

    <p>DAWNSNSへようこそ</p>

    <label for="e-mail" class="form-label">E-mail</label>
    <input class="input" name="mail" type="text">

    <label for="password" class="form-label">Password</label>
    <input class="input" name="password" type="password" value="" id="password">

    <input type="submit" value="ログイン" class="button-submit">

    <p><a href="/register">新規ユーザーの方はこちら</a></p>
</form>

@endsection
