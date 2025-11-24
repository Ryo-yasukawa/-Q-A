@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary text-center mb-4">{{ $question->title }}</h2>

    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body text-center"> {{-- ここで中央揃え --}}
            <p class="fs-5">{{ $question->body }}</p>
            <p class="text-muted">投稿日: {{ $question->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    {{-- 編集・削除ボタン --}}
    <div class="mb-4 text-center">
        <a href="{{ route('mypage.questions.edit', $question->id) }}" class="btn btn-outline-primary me-2">
            <i class="bi bi-pencil-square"></i> 編集
        </a>

        <form action="{{ route('mypage.questions.destroy', $question->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか？')">
                <i class="bi bi-trash"></i> 削除
            </button>
        </form>
    </div>

    {{-- 回答一覧 --}}
    <h4 class="fw-bold text-secondary text-center mb-3">回答一覧</h4>
    @forelse ($question->answers as $answer)
        <div class="card shadow-sm rounded-4 mb-3">
            <div class="card-body text-center"> {{-- 回答を中央揃え --}}
                <p>{{ $answer->body }}</p>
                <p class="text-muted">回答日時: {{ $answer->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    @empty
        <p class="text-center text-muted">まだ回答はありません。</p>
    @endforelse
</div>
@endsection
