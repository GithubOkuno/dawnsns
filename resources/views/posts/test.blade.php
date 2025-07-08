@extends('layouts.login')

@section('content')

<div>
@foreach ($tests as $test)
  <a href="/profile/{{ $test->user_id }}">
    <img src="/storage/images/{{$test->images}}" alt="">
  </a>
  <P>{{ $test->username }}</P>
  <P>{{ $test->created_at }}</P>
  <P>{{ $test->posts }}</P>
  @if(Auth::id() === $test->user_id)
  <br>
        <div class="life-type">
          <a href="" class="modalopen" data-target="{{$test->id}}">
            <img src="/images/edit.png" alt="編集ボタン" name="inputForm" class="form-display">
          </a>
        </div>

        <div class="modal-main js-modal" id="{{$test->id}}">
          <div class="modal-inner">
            <div class="inner-content">
              <form action="http://127.0.0.1:8000/update" method="post" class="form-pop">
                <br>
                @csrf
                <input type="text" name="upPost" value="{{ $test->posts }}">
                <input type="hidden" name="upId" value="{{ $test->id }}">
                <button>
                  <img src="/images/edit.png" alt="編集ボタン">
                </button>
              </form>
              <a class="send-button modalClose">Close</a>
            </div>
          </div>
        </div>

  <img src="" alt="削除ボタン" onclick="return confirm('削除します。よろしいですか？')">
  @endif
@endforeach
</div>

@endsection
