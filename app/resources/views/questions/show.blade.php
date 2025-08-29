@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $question->title }}</h2>
    <p>{{ $question->body }}</p>
    <small class="text-muted">
        投稿者: {{ $question->user->name ?? '不明' }} |
        投稿日: {{ $question->created_at->format('Y-m-d H:i') }}
    </small>

     {{-- ブックマークボタン（ログインユーザーのみ） --}}
    @auth
        <div class="mt-3 mb-3">
            @if(Auth::user()->bookmarks->contains('question_id', $question->id))
                <!-- ブックマーク解除 -->
                <form action="{{ route('bookmarks.destroy', $question->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning">ブックマーク解除</button>
                </form>
            @else
                <!-- ブックマーク追加 -->
                <form action="{{ route('bookmarks.store', $question->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-outline-warning">ブックマーク</button>
                </form>
            @endif
        </div>
    @endauth

    {{-- 回答ボタン（ログインユーザーのみ） --}}
    @auth
        <div class="mt-3 mb-3">
            <a href="{{ route('answers.create', $question->id) }}" class="btn btn-primary">回答する</a>
        </div>
    @endauth

    <hr>

    {{-- 回答一覧 --}}
    <h4>回答一覧</h4>
    @forelse($question->answers as $answer)
        <div class="card mb-2">
            <div class="card-body">
                <p>{{ $answer->body }}</p>
                <small class="text-muted">
                    回答者: {{ $answer->user->name ?? '不明' }} |
                    投稿日: {{ $answer->created_at->format('Y-m-d H:i') }}
                </small>

                {{-- コメント一覧 --}}
                @if($answer->comments->count())
                    <div class="mt-2">
                        <strong>コメント</strong>
                        <ul class="list-group">
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

                {{-- コメント投稿フォーム（ログインユーザーのみ） --}}
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
        <p>まだ回答はありません。</p>
    @endforelse

    <hr>

    {{-- 通報ボタン --}}
    @auth
<form action="{{ route('questions.report', $question->id) }}" method="POST" class="mt-2">
    @csrf
    <div class="mb-2">
        <label for="reason">報告理由（必須）</label>
        <select name="reason" id="reason" class="form-control" required>
            <option value="">選択してください</option>
            <option value="spam">スパム</option>
            <option value="abuse">誹謗中傷</option>
            <option value="other">その他</option>
        </select>
    </div>
    <div class="mb-2">
        <label for="comment">コメント（任意）</label>
        <textarea name="comment" id="comment" class="form-control" rows="2"></textarea>
    </div>
    <button type="submit" class="btn btn-danger">通報する</button>
</form>
@endauth
</div>
@endsection
