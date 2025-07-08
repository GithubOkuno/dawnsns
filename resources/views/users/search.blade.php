@extends('layouts.login')

@section('content')
<!--検索機能-->
<form action="http://127.0.0.1:8000/search" method="post" class="search-form">
  @csrf
  <div class="search-input-wrapper">
    <input type="text" name="username" placeholder="ユーザー名" value="{{ old('username',$keyword) }}" class="search-input">
  </div>
  <div class="search-button-wrapper">
    <button type="submit" class="search-button">検索ボタン</button>
  </div>
</form>

<!--検索ワード表示-->
<p class="search-keyword">検索ワード：{{ old('username',$keyword) }}</p>

<!--ユーザー一覧-->
<div class="userlist-wrapper">
  @foreach ($users as $user)
    <div class="userlist-card">
      <a href="/profile/{{ $user->id }}">
        <img src="/storage/images/{{$user->images}}" alt="" class="userlist-avatar">
      </a>
      <p class="userlist-name">{{ $user->username }}</p>

      @if(in_array($user->id,$follows))
        <form action="http://127.0.0.1:8000/unfollow" method="post" class="userlist-form">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <div class="userlist-button-wrapper">
            <button type="submit" class="userlist-button unfollow">フォローを外す</button>
          </div>
        </form>
      @else
        <form action="http://127.0.0.1:8000/follow" method="post" class="userlist-form">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <div class="userlist-button-wrapper">
            <button type="submit" class="userlist-button">フォローする</button>
          </div>
        </form>
      @endif
    </div>
  @endforeach
</div>




@endsection
