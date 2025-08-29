@extends('layouts.app')

@section('content')
<div class="container">
    <h2>回答編集</h2>

    <form action="{{ route('mypage.answers.update', $answer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="body">本文</label>
            <textarea name="body" class="form-control" rows="5" required>{{ old('body', $answer->body) }}</textarea>
        </div>

        <div class="form-group mt-2">
            <label for="image">画像添付（任意）</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary mt-3">更新</button>
        <a href="{{ route('mypage.answers.show', $answer->id) }}" class="btn btn-secondary mt-3">キャンセル</a>
    </form>
</div>
@endsection
