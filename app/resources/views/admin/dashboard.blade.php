@extends('layouts.admin')

@section('content')
<div class="container py-5 d-flex justify-content-center">
    <div class="col-md-8">

        <div class="text-center mb-4">
            <h1 class="fw-bold text-secondary">管理ダッシュボード</h1>
            <p class="text-secondary">管理対象の一覧ページに移動できます。</p>
        </div>

        <div class="card shadow-sm rounded-4 p-4" style="background: linear-gradient(135deg, #343a40, #212529);">
            <ul class="list-group list-group-flush">
                <li class="list-group-item text-center mb-2 rounded-3" style="background-color: rgba(255,255,255,0.05);">
                    <a href="{{ route('admin.questions.index') }}" class="fw-bold text-light text-decoration-none">
                        質問管理一覧へ
                    </a>
                </li>
                <li class="list-group-item text-center mb-2 rounded-3" style="background-color: rgba(255,255,255,0.05);">
                    <a href="{{ route('admin.answers.index') }}" class="fw-bold text-light text-decoration-none">
                        回答管理一覧へ
                    </a>
                </li>
                <li class="list-group-item text-center rounded-3" style="background-color: rgba(255,255,255,0.05);">
                    <a href="{{ route('admin.users.index') }}" class="fw-bold text-light text-decoration-none">
                        ユーザー管理一覧へ
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>

{{-- ホバー効果 --}}
<style>
    .list-group-item a:hover {
        text-decoration: underline;
        color: #0d6efd; /* ブルー系でアクセント */
    }
    .list-group-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        transition: all 0.3s;
    }
</style>
@endsection
