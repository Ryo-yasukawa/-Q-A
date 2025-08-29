@extends('layouts.app')

@section('content')
<div class="container">
    <h2>質問投稿</h2>

    <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="body">本文</label>
            <textarea name="body" class="form-control" rows="5" required>{{ old('body') }}</textarea>
        </div>

        <div class="form-group">
            <label for="image">画像（任意）</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary mt-3">投稿する</button>
        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">キャンセル</a>
    </form>
</div>
@endsection
