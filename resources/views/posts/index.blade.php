@extends('layouts.login')

@section('content')
<form action="/create" method="post" class="post-form">
  @csrf
  <div style="flex-grow:1;">
    <input type="text" name="newPost" placeholder="何をつぶやこうか…？" class="input-text">
  </div>
  <div class="button">
    <button type="submit" class="button-post">
      <img src="/images/post.png" alt="投稿ボタン" width="24">
    </button>
  </div>
</form>

<div>
@foreach ($posts as $post)
  <div class="post">
    <a href="/profile/{{ $post->user_id }}">
      <img src="/storage/images/{{$post->images}}" alt="" class="user-icon">
    </a>
    <div class="post-content">
      <div class="post-header">
        <span class="username">{{ $post->username }}</span>
        <span class="post-date">{{ $post->created_at }}</span>
      </div>
      <div class="post-body">{{ $post->posts }}</div>

      @if(Auth::id() === $post->user_id)
      <div class="post-actions">
        <a href="" class="modalopen" data-target="{{$post->id}}">
          <img src="/images/edit.png" alt="編集" class="form-display" width="20">
        </a>

        <form action="/delete" method="post" class="inlineblock">
          @csrf
          <input type="hidden" name="deleteId" value="{{ $post->id }}">
          <button class="trash">
            <img src="/images/trash.png" alt="削除" onclick="return confirm('削除します。よろしいですか？')" width="20">
          </button>
        </form>
      </div>

      <div class="modal-main js-modal" id="{{$post->id}}">
        <div class="modal-inner">
          <div class="inner-content">
            <form action="/update" method="post" class="form-pop">
              @csrf
              <input type="text" name="upPost" value="{{ $post->posts }}">
              <input type="hidden" name="upId" value="{{ $post->id }}">
              <button class="button-post">
                <img src="/images/edit.png" alt="編集ボタン" width="20">
              </button>
            </form>
            <a class="send-button modalClose">Close</a>
          </div>
        </div>
      </div>
      @endif
    </div>
  </div>
@endforeach
</div>

@endsection
