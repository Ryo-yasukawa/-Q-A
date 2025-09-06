@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4 text-center fw-bold" style="color: #0a95ff;">質問一覧</h2>

    {{-- 🔍 検索フォーム --}}
    <form action="{{ route('home') }}" method="GET" class="mb-4">
        <div class="row g-2">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control" placeholder="キーワードで検索"
                       value="{{ old('keyword', $keyword ?? '') }}">
            </div>
            <div class="col-md-4">
                <input type="date" name="from_date" class="form-control"
                       value="{{ old('from_date', $from_date ?? '') }}">
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-primary w-100">検索</button>
            </div>
        </div>
    </form>

    {{-- 質問投稿ボタン --}}
    <div class="d-flex justify-content-end mb-3">
        @auth
        <a href="{{ route('questions.create') }}" class="btn btn-success">質問投稿</a>
        @endauth
    </div>

    {{-- 質問一覧 2列表示 --}}
    <div class="row g-3">
        @forelse($questions as $question)
        <div class="col-md-6">
            <div class="card shadow-sm h-100 question-card text-white" style="border-radius: 10px; background: linear-gradient(135deg, #6CC1FF, #3A8DFF);">
                <div class="card-body d-flex flex-column">

                    {{-- 回答数バッジ --}}
                    <div class="d-flex justify-content-end mb-2">
                        <span class="badge bg-light text-primary">{{ $question->answers->count() }} 回答</span>
                    </div>

                    {{-- タイトル --}}
                    <h5 class="card-title">
                        <a href="{{ route('questions.show', $question->id) }}" class="text-decoration-none text-white fw-bold question-title">
                            {{ $question->title }}
                        </a>
                    </h5>

                    {{-- 本文 --}}
                    <p class="card-text text-truncate" style="max-height: 4.5em;">
                        {{ $question->body }}
                    </p>

                    {{-- タグ --}}
                    <div class="mt-auto mb-2">
                        @foreach($question->tags ?? ['タグ1','タグ2'] as $tag)
                            <span class="badge bg-warning text-dark me-1">{{ $tag }}</span>
                        @endforeach
                    </div>

                    {{-- 投稿者・日時 --}}
                    <small class="text-white-50">
                        投稿者: {{ $question->user->name ?? '不明' }} | 投稿日: {{ $question->created_at->format('Y-m-d H:i') }}
                    </small>

                    {{-- 画像 --}}
                    @if($question->image_path)
                        <a href="{{ asset('storage/' . $question->image_path) }}" target="_blank" class="btn btn-light btn-sm mt-2">
                            画像を見る
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="alert alert-info">質問はまだありません。</div>
        @endforelse
    </div>

    {{-- ページネーション --}}
    <div class="mt-3 d-flex justify-content-center">
        {{ $questions->appends(['keyword' => $keyword ?? '', 'from_date' => $from_date ?? ''])->links() }}
    </div>
</div>

{{-- ホバー効果 & タイトル影 --}}
<style>
    .question-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.25);
        transition: all 0.3s;
    }

    /* タイトルリンクを読みやすくする影 */
    .question-title {
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
</style>
@endsection
