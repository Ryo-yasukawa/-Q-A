@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>質問管理一覧</h1>

    @if(session('status'))
        <div style="color: green;">
            {{ session('status') }}
        </div>
    @endif

    <table border="1" cellpadding="8" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>タイトル</th>
                <th>投稿者</th>
                <th>投稿日</th>
                <th>違反報告数</th>
                <th>表示状態</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $q)
                <tr>
                    <td>{{ $q->id }}</td>
                    <td><a href="{{ route('admin.questions.show', $q->id) }}">{{ $q->title }}</a></td>
                    <td>{{ $q->user->name ?? '削除済みユーザー' }}</td>
                    <td>{{ $q->created_at->format('Y-m-d') }}</td>
                    <td>{{ $q->reports_count }}</td>
                    <td>{{ $q->is_visible ? '表示中' : '停止中' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div style="margin-top: 20px;">
        {{ $questions->links() }}
    </div>
</div>
@endsection
