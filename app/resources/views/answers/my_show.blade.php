@extends('layouts.app')

@section('content')
<div class="container">
    {{-- 紐づく質問 --}}
    <div class="mb-4">
        <h3>{{ $answer->question->title }}</h3>
        <p>{{ $answer->question->body }}</p>
        <p class="text-muted">
            質問者: {{ $answer->question->user->name ?? '不明' }} |
            投稿日: {{ $answer->question->created_at->format('Y-m-d H:i') }}
        </p>
    </div>

    {{-- 自分の回答 --}}
    <div class="card mb-3">
        <div class="card-body">
            <p>{{ $answer->body }}</p>
            <p class="text-muted">
                回答日時: {{ $answer->created_at->format('Y-m-d H:i') }}
            </p>
        </div>
    </div>

    {{-- 編集・削除ボタン --}}
    <div class="mb-4">
        <a href="{{ route('mypage.answers.edit', $answer->id) }}" class="btn btn-primary">編集</a>

        <form action="{{ route('mypage.answers.destroy', $answer->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">
                削除
            </button>
        </form>
    </div>
</div>
@endsection

