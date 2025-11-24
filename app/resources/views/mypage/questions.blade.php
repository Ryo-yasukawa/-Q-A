@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold text-primary">自分の質問一覧</h2>

    @if ($questions->count())
        <div class="row g-3">
            @foreach ($questions as $question)
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-3 question-card" style="background: linear-gradient(135deg, #f0f8ff, #e0f2ff);">
                        <div class="card-body text-center">
                            <a href="{{ route('mypage.questions.show', $question->id) }}" class="text-decoration-none fw-bold text-primary d-block mb-2">
                                {{ $question->title }}
                            </a>
                            <small class="text-muted d-block">投稿日: {{ $question->created_at->format('Y-m-d') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $questions->links() }}
        </div>
    @else
        <p class="text-center text-muted">まだ質問はありません。</p>
    @endif

    <div class="text-center my-3">
        <a href="{{ route('mypage') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> マイページに戻る
        </a>
    </div>
</div>

<style>
    .question-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        transition: all 0.3s;
    }
</style>
@endsection
