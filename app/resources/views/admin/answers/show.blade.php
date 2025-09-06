@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>回答詳細管理</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <!-- 回答情報 -->
    <div style="margin-bottom: 20px;">
        <p><strong>ID:</strong> {{ $answer->id }}</p>
        <p><strong>回答内容:</strong> {{ $answer->body }}</p>
        <p><strong>投稿者:</strong> {{ $answer->user->name ?? '削除済みユーザー' }}</p>
        <p><strong>投稿日:</strong> {{ $answer->created_at->format('Y-m-d') }}</p>
        <p><strong>表示状態:</strong> {{ $answer->is_visible ? '表示中' : '停止中' }}</p>
    </div>

<!-- 表示/停止切替ボタン -->
    <form action="{{ route('admin.answers.update', $answer->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('PUT')
        <input type="hidden" name="is_visible" value="{{ $answer->is_visible ? 0 : 1 }}">
        <button type="submit">
            {{ $answer->is_visible ? '非表示にする' : '表示にする' }}
        </button>
    </form>

    <!-- 違反報告一覧 -->
    <h2>違反報告一覧</h2>
    @if($reports->isEmpty())
        <p>報告はありません。</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>報告者</th>
                    <th>理由</th>
                    <th>コメント</th>
                    <th>報告日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $r)
                    <tr>
                        <td>{{ $r->id }}</td>
                        <td>{{ $r->user->name ?? '削除済みユーザー' }}</td>
                        <td>{{ $r->reason }}</td>
                        <td>{{ $r->comment }}</td>
                        <td>{{ $r->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection
