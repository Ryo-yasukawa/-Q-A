@extends('layouts.app')

@section('content')
<div class="container">
    <h2>プロフィール編集</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mypage.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="profile_image">プロフィール画像</label>
            <input type="file" name="profile_image" class="form-control-file">
            @if ($user->profile_image)
                <img src="{{ asset('storage/'.$user->profile_image) }}" alt="プロフィール画像" width="100" class="mt-2">
            @endif
        </div>

        <div class="form-group">
            <label for="introduction">自己紹介</label>
            <textarea name="introduction" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
        </div>

        {{-- 保存・キャンセル --}}
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">保存</button>
            <a href="{{ route('mypage') }}" class="btn btn-secondary">キャンセル</a>
        </div>

        <!-- {{-- 退会ボタン --}}
        
        <div class="form-group mt-3">
            <form action="{{ route('mypage.withdraw.confirm') }}">
        
                <button type="submit" class="btn btn-danger">退会する</button> 
            </form>
        </div>  -->
        {{-- 退会ボタン --}}
           <div class="form-group mt-3">
            <a href="{{ route('mypage.withdraw.confirm') }}" class="btn btn-danger"
              onclick="return confirm('本当に退会しますか？');">
              退会する
              </a>
</div>


    </form>
</div>
@endsection
