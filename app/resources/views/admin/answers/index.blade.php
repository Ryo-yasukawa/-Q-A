@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>回答管理一覧</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>回答内容</th>
                <th>投稿者</th>
                <th>投稿日</th>
                <th>違反報告数</th>
                <th>表示状態</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answers as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>
                        <a href="{{ route('admin.answers.show', $a->id) }}">
                            {{ Str::limit($a->body, 50) }}
                        </a>
                    </td>
                    <td>{{ $a->user->name ?? '削除済みユーザー' }}</td>
                    <td>{{ $a->created_at->format('Y-m-d') }}</td>
                    <td>{{ $a->reports_count }}</td>
                    <td>{{ $a->is_visible ? '表示中' : '停止中' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div style="margin-top: 20px;">
        {{ $answers->links() }}
    </div>
</div>
@endsection
