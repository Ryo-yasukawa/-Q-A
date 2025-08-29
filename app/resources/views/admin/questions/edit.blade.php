@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>質問編集（管理者用）</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- タイトル（表示のみ） -->
        <div style="margin-bottom: 10px;">
            <label><strong>タイトル:</strong></label>
            <p>{{ $question->title }}</p>
        </div>

        <!-- 本文（表示のみ） -->
        <div style="margin-bottom: 10px;">
            <label><strong>本文:</strong></label>
            <p>{{ $question->body }}</p>
        </div>

        <!-- 表示状態 -->
        <div style="margin-bottom: 10px;">
            <label><strong>表示状態:</strong></label><br>
            <input type="checkbox" name="is_visible" value="1" {{ $question->is_visible ? 'checked' : '' }}> 表示する
        </div>

        <button type="submit">保存</button>
        <a href="{{ route('admin.questions.show', $question->id) }}">
            <button type="button">キャンセル</button>
        </a>
    </form>
</div>
@endsection
