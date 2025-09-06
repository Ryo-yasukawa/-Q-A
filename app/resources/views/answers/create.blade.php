@extends('layouts.app')

@section('content')
<div class="container">
    <h2>回答投稿</h2>

    {{-- 質問タイトル --}}
    <div class="mb-3">
        <h5>{{ $question->title }}</h5>
        <p>{{ $question->body }}</p>
    </div>

    {{-- 回答投稿フォーム --}}
    <form action="{{ route('answers.store', $question->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="body">回答本文</label>
            <textarea name="body" class="form-control" rows="5">{{ old('body') }}</textarea>
            @error('body')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-2">
            <label for="image">画像添付（任意）</label>
            <input type="file" name="image" class="form-control">
             @error('image')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">投稿する</button>
        <a href="{{ route('questions.show', $question->id) }}" class="btn btn-secondary mt-3">キャンセル</a>
    </form>
</div>
@endsection
