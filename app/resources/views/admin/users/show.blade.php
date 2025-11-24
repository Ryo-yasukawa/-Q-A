@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h1 class="fw-bold text-secondary text-center mb-4">ユーザー詳細管理</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- ユーザー情報カード -->
    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-body d-flex flex-column align-items-center text-center">
            
            {{-- プロフィール画像 --}}
            @if($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" 
                     alt="プロフィール画像" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
            @else
                <div class="rounded-circle bg-secondary mb-3" style="width: 120px; height: 120px; display:flex; align-items:center; justify-content:center; color:white; font-size:24px;">
                    {{ strtoupper(substr($user->name,0,1)) }}
                </div>
            @endif

            <p><strong>ID:</strong> {{ $user->id }}</p>
            <p><strong>ユーザー名:</strong> {{ $user->name }}</p>
            <p><strong>メールアドレス:</strong> {{ $user->email }}</p>
            <p><strong>利用状態:</strong>
                @if($user->is_active)
                    <span class="badge bg-success">有効</span>
                @else
                    <span class="badge bg-secondary">停止中</span>
                @endif
            </p>
            <p><strong>停止質問件数:</strong> {{ $user->questions->where('is_visible',0)->count() }}</p>
            <p><strong>停止回答件数:</strong> {{ $user->answers->where('is_visible',0)->count() }}</p>
        </div>
    </div>

    <!-- 利用状態切替ボタン -->
    <div class="text-center mb-4">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="is_active" value="{{ $user->is_active ? 0 : 1 }}">
            <button type="submit" class="btn {{ $user->is_active ? 'btn-secondary' : 'btn-success' }}">
                {{ $user->is_active ? '利用停止にする' : '利用再開する' }}
            </button>
        </form>
    </div>

    <!-- 通報された質問の内容 -->
    <h2 class="fw-bold mb-3">通報された質問</h2>
    @if($reportedQuestions->isEmpty())
        <p class="text-center">通報された質問はありません。</p>
    @else
        <div class="card shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">
                <ul class="list-group list-group-flush">
                    @foreach($reportedQuestions as $question)
                        @foreach($question->reports as $report)
                            <li class="list-group-item">
                                <strong>理由:</strong> {{ $report->reason }}<br>
                                <strong>コメント:</strong> {{ $report->comment ?? 'なし' }}
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- 通報された回答の内容 -->
    <h2 class="fw-bold mb-3">通報された回答</h2>
    @if($reportedAnswers->isEmpty())
        <p class="text-center">通報された回答はありません。</p>
    @else
        <div class="card shadow-sm rounded-4 mb-4">
            <div class="card-body p-3">
                <ul class="list-group list-group-flush">
                    @foreach($reportedAnswers as $answer)
                        @foreach($answer->reports as $report)
                            <li class="list-group-item">
                                <strong>理由:</strong> {{ $report->reason }}<br>
                                <strong>コメント:</strong> {{ $report->comment ?? 'なし' }}
                            </li>
                        @endforeach
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

</div>
@endsection
