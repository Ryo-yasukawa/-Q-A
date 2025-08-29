@extends('layouts.app')

@section('content')
<div class="container">
    <h2>自分の質問一覧</h2>

    @if ($questions->count())
        <ul class="list-group">
            @foreach ($questions as $question)
                <li class="list-group-item">
                    <a href="{{ route('mypage.questions.show', $question->id) }}">
                        {{ $question->title }}
                    </a>
                    <small class="text-muted d-block">投稿日: {{ $question->created_at->format('Y-m-d') }}</small>
                </li>
            @endforeach
        </ul>
        <div class="mt-3">
            {{ $questions->links() }}
        </div>
    @else
        <p>まだ質問はありません。</p>
    @endif
</div>
@endsection
