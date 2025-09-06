@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>ユーザー詳細管理</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <!-- ユーザー情報 -->
    <div style="margin-bottom: 20px;">
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>ユーザー名:</strong> {{ $user->name }}</p>
        <p><strong>メールアドレス:</strong> {{ $user->email }}</p>
        <p><strong>利用状態:</strong> {{ $user->is_active ? '有効' : '停止中' }}</p>
        <p><strong>停止質問件数:</strong> {{ $user->questions->where('is_visible',0)->count() }}</p>
        <p><strong>停止回答件数:</strong> {{ $user->answers->where('is_visible',0)->count() }}</p>
    </div>

<!-- 利用状態切替ボタン -->
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PUT')
        <input type="hidden" name="is_active" value="{{ $user->is_active ? 0 : 1 }}">
        <button type="submit">
            {{ $user->is_active ? '利用停止にする' : '利用再開する' }}
        </button>
    </form>

    <!-- 通報された質問の内容 -->
<h2>通報された質問</h2>
@if($reportedQuestions->isEmpty())
    <p>通報された質問はありません。</p>
@else
    <ul>
        @foreach($reportedQuestions as $question)
            @foreach($question->reports as $report)
                <li>
                    <strong>理由:</strong> {{ $report->reason }}<br>
                    <strong>コメント:</strong> {{ $report->comment ?? 'なし' }}
                </li>
            @endforeach
        @endforeach
    </ul>
@endif

<!-- 通報された回答の内容 -->
<h2>通報された回答</h2>
@if($reportedAnswers->isEmpty())
    <p>通報された回答はありません。</p>
@else
    <ul>
        @foreach($reportedAnswers as $answer)
            @foreach($answer->reports as $report)
                <li>
                    <strong>理由:</strong> {{ $report->reason }}<br>
                    <strong>コメント:</strong> {{ $report->comment ?? 'なし' }}
                </li>
            @endforeach
        @endforeach
    </ul>
@endif


</div>
@endsection
