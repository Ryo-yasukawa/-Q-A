@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>ユーザー詳細管理</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <!-- ユーザー情報 -->
    <div style="margin-bottom: 20px;">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>ユーザー名:</strong> {{ $user->name }}</p>
        <p><strong>メールアドレス:</strong> {{ $user->email }}</p>
        <p><strong>利用状態:</strong> {{ $user->is_active ? '有効' : '停止中' }}</p>
        <p><strong>停止質問件数:</strong> {{ $user->questions->where('is_visible',0)->count() }}</p>
        <p><strong>停止回答件数:</strong> {{ $user->answers->where('is_visible',0)->count() }}</p>
    </div>

    <!-- 編集ボタン -->
    <div style="margin-top: 20px;">
        <a href="{{ route('admin.users.edit', $user->id) }}">
            <button>編集</button>
        </a>
    </div>

</div>
@endsection
