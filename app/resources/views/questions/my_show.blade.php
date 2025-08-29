@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ $question->title }}</h2>

    <div class="card mb-4">
        <div class="card-body">
            <p>{{ $question->body }}</p>
            <p class="text-muted">投稿日: {{ $question->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    {{-- 編集・削除ボタン --}}
    <div class="mb-4">
        <a href="{{ route('mypage.questions.edit', $question->id) }}" class="btn btn-primary">編集</a>

        <form action="{{ route('mypage.questions.destroy', $question->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">
                削除
            </button>
        </form>
    </div>

    {{-- 回答一覧 --}}
    <h4>回答一覧</h4>
    @forelse ($question->answers as $answer)
        <div class="card mb-3">
            <div class="card-body">
                <p>{{ $answer->body }}</p>
                <p class="text-muted">回答日時: {{ $answer->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    @empty
        <p>まだ回答はありません。</p>
    @endforelse
</div>
@endsection
