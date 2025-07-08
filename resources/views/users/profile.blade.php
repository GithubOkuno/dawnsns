@extends('layouts.login')

@section('content')

<div class="profile-card">
  <p class="profile-section-title">相手のプロフィール</p>

  <img src="/storage/images/{{ $profiles->images }}" alt="" class="profile-avatar">

  <div class="profile-info">
    <p class="profile-label-text">Name</p>
    <p class="profile-text">{{ $profiles->username }}</p>

    <p class="profile-label-text">Bio</p>
    <p class="profile-text">{{ $profiles->bio }}</p>
  </div>

  @if(in_array($profiles->id,$follows))
    <form action="http://127.0.0.1:8000/unfollow" method="post" class="follow-form">
      @csrf
      <input type="hidden" name="user_id" value="{{ $profiles->id }}">
      <div class="follow-button-wrapper">
        <button type="submit" class="follow-button unfollow">フォローを外す</button>
      </div>
    </form>
  @else
    <form action="http://127.0.0.1:8000/follow" method="post" class="follow-form">
      @csrf
      <input type="hidden" name="user_id" value="{{ $profiles->id }}">
      <div class="follow-button-wrapper">
        <button type="submit" class="follow-button">フォローする</button>
      </div>
    </form>
  @endif
</div>


@foreach ($profilePosts as $profilePost)
<div class="post">
  <a href="/profile/{{ $profilePost->id }}">
    <img src="/storage/images/{{$profilePost->images}}" alt="" class="user-icon">
  </a>
  <div class="post-content">
    <div class="post-header">
      <P>{{ $profilePost->username }}</P>
      <P>{{ $profilePost->created_at }}</P>
    </div>
    <div class="post-body">{{ $profilePost->posts }}</div>
  </div>
</div>
@endforeach

@endsection
