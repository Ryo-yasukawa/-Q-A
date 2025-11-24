@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- 質問カード --}}
    <div class="card mb-4 shadow-sm rounded-4" style="background: linear-gradient(135deg, #e0f0ff, #c0e4ff);">
        <div class="card-body">
            <h2 class="fw-bold text-primary mb-3">{{ $question->title }}</h2>

            {{-- 画像 --}}
            @if($question->image_path)
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/' . $question->image_path) }}" 
                         alt="質問画像" class="rounded" style="max-width: 100%; height: auto;">
                </div>
            @endif

            <p class="mb-3">{{ $question->body }}</p>

            {{-- 投稿者・日時 --}}
            <div class="d-flex justify-content-between mb-3">
                <small class="text-muted">
                    投稿者: {{ $question->user->name ?? '不明' }}
                </small>
                <small class="text-muted">
                    投稿日: {{ $question->created_at->format('Y-m-d H:i') }}
                </small>
            </div>

            {{-- ボタン類 --}}
            <div class="d-flex gap-2">
                @auth
                    {{-- お気に入りボタン（緑系） --}}
                    <button 
                        class="btn bookmark-btn {{ $question->isBookmarkedBy(Auth::id()) ? 'btn-success' : 'btn-outline-success' }}" 
                        data-question-id="{{ $question->id }}" 
                        data-bookmarked="{{ $question->isBookmarkedBy(Auth::id()) ? 'true' : 'false' }}">
                        {{ $question->isBookmarkedBy(Auth::id()) ? '★ お気に入り解除' : '☆ お気に入り' }}
                    </button>

                    {{-- 回答ボタン（青系） --}}
                    <a href="{{ route('answers.create', $question->id) }}" class="btn btn-primary">質問に回答する</a>

                    {{-- 通報ボタン（赤系） --}}
                    <a href="{{ route('questions.report.show', $question->id) }}" class="btn btn-danger ms-auto">
                        質問を通報する
                    </a>
                @endauth
            </div>
        </div>
    </div>

    {{-- 回答一覧 --}}
    <h4 class="mb-3 fw-bold">回答一覧</h4>
    @forelse($answers as $answer)
        <div class="card mb-3 shadow-sm rounded-3 answer-card" style="background: linear-gradient(135deg, #f0f8ff, #d9f0ff);">
            <div class="card-body">
                <p>{{ $answer->body }}</p>

                {{-- 回答画像 --}}
                @if($answer->image_path)
                    <div class="mb-2 text-center">
                        <img src="{{ asset('storage/' . $answer->image_path) }}" 
                             alt="回答画像" class="rounded" style="max-width: 70%; height: auto;">
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <small class="text-muted">
                        回答者: {{ $answer->user->name ?? '不明' }}
                    </small>
                    <small class="text-muted">
                        投稿日: {{ $answer->created_at->format('Y-m-d H:i') }}
                    </small>
                </div>

                {{-- 通報ボタン --}}
                @auth
                    <div class="mb-2">
                        <a href="{{ route('answers.report.form', $answer->id) }}" class="btn btn-danger btn-sm">
                         回答を通報する
                        </a>
                    </div>
                @endauth

                {{-- コメント --}}
                @if($answer->comments->count())
                    <div class="mb-2">
                        <strong>コメント</strong>
                        <ul class="list-group list-group-flush">
                            @foreach($answer->comments->sortBy('created_at') as $comment)
                                <li class="list-group-item">
                                    {{ $comment->body }}
                                    <small class="text-muted d-block">
                                        投稿者: {{ $comment->user->name ?? '不明' }} |
                                        投稿日: {{ $comment->created_at->format('Y-m-d H:i') }}
                                    </small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- コメント投稿フォーム --}}
                @auth
                    <form action="{{ route('comments.store', $answer->id) }}" method="POST" class="mt-2">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="body" class="form-control" placeholder="コメントを入力" required>
                            <button type="submit" class="btn btn-secondary">投稿</button>
                        </div>
                    </form>
                @endauth
            </div>
        </div>
    @empty
        <p class="text-muted">まだ回答はありません。</p>
    @endforelse

</div>

{{-- ホバー効果（回答カードのみ） --}}
<style>
    .answer-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        transition: all 0.3s;
    }
</style>
@endsection
