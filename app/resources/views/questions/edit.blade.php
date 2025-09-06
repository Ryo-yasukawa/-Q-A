@extends('layouts.app')

@section('content')
<div class="container">
    <h2>質問編集</h2>

    <form action="{{ route('mypage.questions.update', $question->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- PUTメソッドを指定 --}}

        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $question->title) }}" required>
        </div>

        <div class="form-group">
            <label for="body">本文</label>
            <textarea name="body" class="form-control" rows="5" required>{{ old('body', $question->body) }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">画像（必須）</label>
            <input type="file" name="image" class="form-control-file">
            @if($question->image_path)
                <p class="mt-2">現在の画像: <a href="{{ asset('storage/' . $question->image_path) }}" target="_blank">表示</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary mt-3">更新する</button>
        <a href="{{ route('mypage.questions.show', $question->id) }}" class="btn btn-secondary mt-3">キャンセル</a>
    </form>
</div>
@endsection
