@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="text-center mb-4">マイページ</h2>

    {{-- プロフィールカード --}}
    <div class="card mb-4 shadow-lg border-0 text-center p-3" 
         style="border-radius: 20px; background: linear-gradient(135deg, #6CC1FF, #3A8DFF); color: white;">
         
        {{-- アイコンを中央揃え --}}
        <div class="d-flex justify-content-center mb-3">
            <img src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : asset('images/default.png') }}" 
                 alt="プロフィール画像" class="rounded-circle" width="120" style="border: 3px solid white;">
        </div>
        
        {{-- ユーザー名・メール --}}
        <h3 class="fw-bold">{{ $user->name }}</h3>
        <p>{{ $user->email }}</p>

        {{-- プロフィール編集ボタン --}}
        <a href="{{ route('mypage.edit') }}" class="btn btn-light fw-bold mt-2">プロフィール編集</a>
    </div>

    {{-- 投稿履歴カード --}}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-header bg-primary text-white text-center fw-bold fs-5" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    投稿履歴
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{route('mypage.questions') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        自分の質問一覧
                        <span class="badge bg-primary rounded-pill">{{ $user->questions->count() }}</span>
                    </a>
                    <a href="{{route('mypage.answers') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        自分の回答一覧
                        <span class="badge bg-primary rounded-pill">{{ $user->answers->count() }}</span>
                    </a>
                    <a href="{{route('mypage.bookmarks') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        ブックマーク一覧
                        <span class="badge bg-primary rounded-pill">{{ $user->bookmarks->count() }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
