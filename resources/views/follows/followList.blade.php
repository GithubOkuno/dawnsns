@extends('layouts.login')

@section('content')

<h1>Follow List</h1>

<div>
@foreach ($followLists as $followList)
<a href="/profile/{{ $followList->id }}">
  <img src="/storage/images/{{$followList->images}}" alt="" class="user-icon">
</a>
@endforeach
</div>

<div>
@foreach ($followusersposts as $followuserspost)
  <div class="post">
    <a href="/profile/{{ $followuserspost->id }}">
      <img src="/storage/images/{{$followuserspost->images}}" alt="" class="user-icon">
    </a>
    <div class="post-content">
      <div class="post-header">
        <P>{{ $followuserspost->username }}</P>
        <P>{{ $followuserspost->created_at }}</P>
      </div>
      <div class="post-body">{{ $followuserspost->posts }}</div>
    </div>
  </div>
@endforeach
</div>


@endsection
