@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="container py-4">
    <h2 class="mb-4 text-center fw-bold text-primary">自分の回答一覧</h2>

    @if ($answers->count())
        <div class="row g-3">
            @foreach ($answers as $answer)
                <div class="col-md-6">
                    <div class="card shadow-sm rounded-3 answer-card" style="background: linear-gradient(135deg, #f0f8ff, #e0f2ff);">
                        <div class="card-body text-center">
                            <a href="{{ route('mypage.answers.show', $answer->id) }}" class="text-decoration-none fw-bold text-primary d-block mb-2">
                                {{ Str::limit($answer->body, 100) }}
                            </a>
                            <small class="text-muted d-block">回答日時: {{ $answer->created_at->format('Y-m-d') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $answers->links() }}
        </div>
    @else
        <p class="text-center text-muted">まだ回答はありません。</p>
    @endif

    <div class="text-center my-3">
        <a href="{{ route('mypage') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> マイページに戻る
        </a>
    </div>
</div>

<style>
    .answer-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        transition: all 0.3s;
    }
</style>
@endsection


