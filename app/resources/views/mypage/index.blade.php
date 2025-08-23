@extends('layouts.app')

@section('content')
<div class="container">
    <h2>マイページ</h2>

    <div class="card mb-3">
        <div class="card-body text-center">
            {{-- プロフィール画像 --}}
            <img src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : asset('images/default.png') }}" 
                 alt="プロフィール画像" class="rounded-circle mb-2" width="120">

            {{-- ユーザー名・メール --}}
            <h4>{{ $user->name }}</h4>
            <p>{{ $user->email }}</p>

            {{-- プロフィール編集ボタン --}}
            <a href="{{ route('mypage.edit') }}" class="btn btn-primary">プロフィール編集</a>
        </div>
    </div>

    {{-- 投稿履歴メニュー --}}
    <div class="list-group">
        <a href="{{route('mypage.questions') }}" class="list-group-item list-group-item-action">自分の質問一覧</a>
        <a href="{{route('mypage.answers') }}" class="list-group-item list-group-item-action">自分の回答一覧</a>
        <a href="{{route('mypage.bookmarks') }}" class="list-group-item list-group-item-action">ブックマーク一覧</a>
    </div>
</div>
@endsection
