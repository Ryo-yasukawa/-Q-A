@extends('layouts.app')

@section('content')
<div class="container">
    <h2>質問一覧</h2>

    {{-- 🔍 検索フォーム --}}
    <form action="{{ route('home') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="keyword" class="form-control"
                   placeholder="キーワードで検索"
                   value="{{ old('keyword', $keyword ?? '') }}">
            <button type="submit" class="btn btn-primary">検索</button>
        </div>
    </form>
         <div class="d-flex justify-content-end mb-3">
             @auth
            <a href="{{ route('questions.create') }}" class="btn btn-success">質問投稿</a>
             @endauth
        </div>



    {{-- 📋 質問一覧 --}}
    @forelse($questions as $question)
        <div class="card mb-3">
            <div class="card-body">
                <h5>
                      <a href="{{ route('questions.show', $question->id) }}"> 
                        {{ $question->title }}
                      </a>
                </h5>
                <p>{{ Str::limit($question->body, 100) }}</p>
                <small>
                    投稿者: {{ $question->user->name ?? '不明' }} |
                    投稿日: {{ $question->created_at->format('Y-m-d H:i') }}
                </small>
            </div>
        </div>
    @empty
        <p>質問はまだありません。</p>
    @endforelse

    {{-- 📌 ページネーション --}}
    <div class="mt-3">
        {{ $questions->appends(['keyword' => $keyword])->links() }}
    </div>
</div>
@endsection
