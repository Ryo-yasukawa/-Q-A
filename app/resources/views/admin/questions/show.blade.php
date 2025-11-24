@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h1 class="fw-bold text-secondary text-center mb-4">質問詳細管理</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- 質問情報カード -->
    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body d-flex flex-wrap align-items-center">
            <!-- 左側：テキスト情報 -->
            <div class="flex-grow-1 me-3">
                <p><strong>ID:</strong> {{ $question->id }}</p>
                <p><strong>タイトル:</strong> {{ $question->title }}</p>
                <p><strong>本文:</strong> {{ $question->body }}</p>
                <p><strong>投稿者:</strong> {{ $question->user->name ?? '削除済みユーザー' }}</p>
                <p><strong>投稿日:</strong> {{ $question->created_at->format('Y-m-d') }}</p>
                <p>
                    <strong>表示状態:</strong>
                    @if($question->is_visible)
                        <span class="badge bg-success">表示中</span>
                    @else
                        <span class="badge bg-secondary">停止中</span>
                    @endif
                </p>

                <!-- 表示/停止切替ボタン -->
                <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" class="mt-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_visible" value="{{ $question->is_visible ? 0 : 1 }}">
                    <button type="submit" class="btn btn-primary">
                        {{ $question->is_visible ? '非表示にする' : '表示にする' }}
                    </button>
                </form>
            </div>

            <!-- 右側：画像 -->
            @if($question->image_path)
                <div class="text-center">
                    <img src="{{ asset('storage/' . $question->image_path) }}" class="rounded" style="max-width: 250px; height: auto;">
                </div>
            @endif
        </div>
    </div>

    <!-- 違反報告一覧 -->
    <h2 class="fw-bold mb-3">違反報告一覧</h2>
    @if($reports->isEmpty())
        <p>報告はありません。</p>
    @else
        <div class="card shadow-sm rounded-4">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
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
            </div>
        </div>
    @endif

</div>
@endsection
