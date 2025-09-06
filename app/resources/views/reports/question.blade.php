@extends('layouts.app')

@section('content')
<div class="container">
    <h2>質問通報</h2>
    <p>通報対象: {{ $question->title }}</p>

    <form action="{{ route('questions.report.store', $question->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="reason">報告理由（必須）</label>
            <select name="reason" id="reason" class="form-control" required>
                <option value="">選択してください</option>
                <option value="spam">スパム</option>
                <option value="abuse">誹謗中傷</option>
                <option value="other">その他</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="comment">コメント（任意）</label>
            <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-danger">通報する</button>
        <a href="{{ route('questions.show', $question->id) }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection
