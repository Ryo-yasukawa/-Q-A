@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>ユーザー管理一覧</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
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
                        <a href="{{ route('admin.users.show', $u->id) }}">
                            {{ $u->name }}
                        </a>
                    </td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->stopped_questions_count }}</td>
                    <td>{{ $u->stopped_answers_count }}</td>
                    <td>{{ $u->is_active ? '有効' : '停止中' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div style="margin-top: 20px;">
        {{ $users->links() }}
    </div>
</div>
@endsection
