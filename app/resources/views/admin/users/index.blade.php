@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <h1 class="fw-bold text-secondary text-center mb-4">ユーザー管理一覧</h1>

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card shadow-sm rounded-4">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>ユーザー名</th>
                        <th>メールアドレス</th>
                        <th>停止質問件数</th>
                        <th>停止回答件数</th>
                        <th>利用状態</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>
                                <a href="{{ route('admin.users.show', $u->id) }}" class="text-decoration-none text-primary">
                                    {{ $u->name }}
                                </a>
                            </td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->stopped_questions_count }}</td>
                            <td>{{ $u->stopped_answers_count }}</td>
                            <td>
                                @if($u->is_active)
                                    <span class="badge bg-success">有効</span>
                                @else
                                    <span class="badge bg-secondary">停止中</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- ページネーション -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $users->links() }}
    </div>
</div>
@endsection
