@extends('layouts.app')

@section('content')
<div class="container">
    <h2>回答の通報</h2>

    <p><strong>質問:</strong> {{ $answer->question->title ?? '削除済みの質問' }}</p>
    <p><strong>回答内容:</strong> {{ $answer->body }}</p>

    <form method="POST" action="{{ route('answers.report.submit', $answer->id) }}">
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
</div>
@endsection
