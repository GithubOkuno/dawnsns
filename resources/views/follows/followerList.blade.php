@extends('layouts.login')

@section('content')

<h1>followerer List</h1>

<div>
@foreach ($followerLists as $followerList)
<a href="/profile/{{ $followerList->id }}">
  <img src="/storage/images/{{$followerList->images}}" alt="" class="user-icon">
</a>
@endforeach
</div>

<div>
@foreach ($followerusersposts as $followeruserspost)
  <div class="post">
    <a href="/profile/{{ $followeruserspost->id }}">
      <img src="/storage/images/{{$followeruserspost->images}}" alt="" class="user-icon">
    </a>
    <div class="post-content">
      <div class="post-header">
        <P>{{ $followeruserspost->username }}</P>
        <P>{{ $followeruserspost->created_at }}</P>
      </div>
      <div class="post-body">{{ $followeruserspost->posts }}</div>
    </div>
  </div>
@endforeach
</div>

@endsection
