@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold text-primary">お気に入り一覧</h2>

    @if ($bookmarks->count())
        <div class="row g-3">
            @foreach ($bookmarks as $bookmark)
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-3 bookmark-card" style="background: linear-gradient(135deg, #f0f8ff, #e0f2ff);">
                        <div class="card-body text-center">
                            @if($bookmark->question)
                                <a href="{{ route('questions.show', $bookmark->question->id) }}" class="text-decoration-none fw-bold text-primary d-block mb-2">
                                    {{ $bookmark->question->title }}
                                </a>
                                <small class="text-muted d-block">
                                    投稿日: {{ $bookmark->question->created_at->format('Y-m-d') }}
                                </small>
                            @else
                                <span class="text-muted d-block fw-bold mb-2">削除済みの質問</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $bookmarks->links() }}
        </div>
    @else
        <p class="text-center text-muted">まだお気に入りはありません。</p>
    @endif

    <div class="text-center my-3">
        <a href="{{ route('mypage') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> マイページに戻る
        </a>
    </div>
</div>

<style>
    .bookmark-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        transition: all 0.3s;
    }
</style>
@endsection
