@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- 紐づく質問 --}}
    @if($answer->question)
        <div class="card shadow-sm rounded-4 mb-4">
            <div class="card-body text-center">
                <h3 class="fw-bold text-primary">{{ $answer->question->title }}</h3>
                <p class="fs-5">{{ $answer->question->body }}</p>
                <p class="text-muted">
                    質問者: {{ $answer->question->user->name ?? '不明' }} |
                    投稿日: {{ $answer->question->created_at->format('Y-m-d H:i') }}
                </p>
            </div>
        </div>
    @else
        <p class="text-center text-muted mb-4">この回答の質問は削除されています。</p>
    @endif

    {{-- 自分の回答 --}}
    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body text-center">
            <p class="fs-5">{{ $answer->body }}</p>
            <p class="text-muted">回答日時: {{ $answer->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    {{-- 編集・削除ボタン --}}
    <div class="mb-4 text-center">
        <a href="{{ route('mypage.answers.edit', $answer->id) }}" class="btn btn-outline-primary me-2">
            <i class="bi bi-pencil-square"></i> 編集
        </a>

        <form action="{{ route('mypage.answers.destroy', $answer->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('本当に削除しますか？')">
                <i class="bi bi-trash"></i> 削除
            </button>
        </form>
    </div>

</div>
@endsection
