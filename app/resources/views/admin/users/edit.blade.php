@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>ユーザー編集（管理者用）</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ユーザー名（表示のみ） -->
        <div style="margin-bottom: 10px;">
            <label><strong>ユーザー名:</strong></label>
            <p>{{ $user->name }}</p>
        </div>

        <!-- メールアドレス（表示のみ） -->
        <div style="margin-bottom: 10px;">
            <label><strong>メールアドレス:</strong></label>
            <p>{{ $user->email }}</p>
        </div>

        <!-- 利用状態 -->
        <div style="margin-bottom: 10px;">
            <label><strong>利用状態:</strong></label><br>
            <input type="checkbox" name="is_active" value="1" {{ $user->is_active ? 'checked' : '' }}> 有効にする
        </div>

        <button type="submit">保存</button>
        <a href="{{ route('admin.users.show', $user->id) }}">
            <button type="button">キャンセル</button>
        </a>
    </form>
</div>
@endsection
