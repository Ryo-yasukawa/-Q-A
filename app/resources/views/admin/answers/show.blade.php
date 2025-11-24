@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h1 class="fw-bold text-secondary text-center mb-4">回答詳細管理</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body d-flex flex-wrap align-items-start gap-3 
                    @if(!$answer->image_path) justify-content-center @endif">
            <div class="flex-grow-1 text-center @if($answer->image_path) text-start @endif">
                <p><strong>ID:</strong> {{ $answer->id }}</p>
                <p><strong>回答内容:</strong> {{ $answer->body }}</p>
                <p><strong>投稿者:</strong> {{ $answer->user->name ?? '削除済みユーザー' }}</p>
                <p><strong>投稿日:</strong> {{ $answer->created_at->format('Y-m-d') }}</p>
                <p>
                    <strong>表示状態:</strong>
                    @if($answer->is_visible)
                        <span class="badge bg-success">表示中</span>
                    @else
                        <span class="badge bg-secondary">停止中</span>
                    @endif
                </p>
            </div>

            {{-- 画像があれば右側に表示 --}}
            @if($answer->image_path)
                <div class="text-center">
                    <img src="{{ asset('storage/' . $answer->image_path) }}" alt="回答画像" class="rounded" style="max-width: 200px; height: auto;">
                </div>
            @endif
        </div>
    </div>

    <!-- 表示/停止切替ボタン -->
    <form action="{{ route('admin.answers.update', $answer->id) }}" method="POST" class="mb-4 text-center">
        @csrf
        @method('PUT')
        <input type="hidden" name="is_visible" value="{{ $answer->is_visible ? 0 : 1 }}">
        <button type="submit" class="btn {{ $answer->is_visible ? 'btn-secondary' : 'btn-success' }}">
            {{ $answer->is_visible ? '非表示にする' : '表示にする' }}
        </button>
    </form>

    <!-- 違反報告一覧 -->
    <h2 class="fw-bold mb-3">違反報告一覧</h2>
    @if($reports->isEmpty())
        <p class="text-center">報告はありません。</p>
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

