@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>回答編集（管理者用）</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('admin.answers.update', $answer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- 回答内容（表示のみ） -->
        <div style="margin-bottom: 10px;">
            <label><strong>回答内容:</strong></label>
            <p>{{ $answer->body }}</p>
        </div>

        <!-- 表示状態 -->
        <div style="margin-bottom: 10px;">
            <label><strong>表示状態:</strong></label><br>
            <input type="checkbox" name="is_visible" value="1" {{ $answer->is_visible ? 'checked' : '' }}> 表示する
        </div>

        <button type="submit">保存</button>
        <a href="{{ route('admin.answers.show', $answer->id) }}">
            <button type="button">キャンセル</button>
        </a>
    </form>
</div>
@endsection
