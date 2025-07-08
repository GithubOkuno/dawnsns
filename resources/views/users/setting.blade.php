@extends('layouts.login')

@section('content')

<form action="/profile" method="post" enctype="multipart/form-data" class="profile-form">
  @csrf

  <div class="profile-form-group">
    <label class="profile-label">UserName</label>
    @if ($errors->has('upUsername'))
      <span class="profile-error">{{ $errors->first('upUsername') }}</span>
    @endif
    <input type="text" name="upUsername" value="{{ $setting->username }}" class="profile-input">
  </div>

  <div class="profile-form-group">
    <label class="profile-label">MailAddress</label>
    @if ($errors->has('upMail'))
      <span class="profile-error">{{ $errors->first('upMail') }}</span>
    @endif
    <input type="text" name="upMail" value="{{ $setting->mail }}" class="profile-input">
  </div>

  <div class="profile-form-group">
    <label class="profile-label">New Password</label>
    @if ($errors->has('upPassword'))
      <span class="profile-error">{{ $errors->first('upPassword') }}</span>
    @endif
    <input type="text" name="upPassword" class="profile-input">
  </div>

  <div class="profile-form-group">
    <label class="profile-label">PassWord confirm</label>
    @if ($errors->has('upPasswordConfirm'))
      <span class="profile-error">{{ $errors->first('upPasswordConfirm') }}</span>
    @endif
    <input type="text" name="upPasswordConfirm" class="profile-input">
  </div>

  <div class="profile-form-group">
    <label class="profile-label">Bio</label>
    @if ($errors->has('upBio'))
      <span class="profile-error">{{ $errors->first('upBio') }}</span>
    @endif
    <input type="text" name="upBio" value="{{ $setting->bio }}" class="profile-input">
  </div>

  <div class="profile-form-group">
    <label class="profile-label">Icon Image</label>
    @if ($errors->has('upimages'))
      <span class="profile-error">{{ $errors->first('upimages') }}</span>
    @endif
    <input type="file" name="upimages" class="profile-file-input">
  </div>

  <div>
    <button type="submit" class="profile-submit-btn">更新</button>
  </div>
</form>

@endsection
