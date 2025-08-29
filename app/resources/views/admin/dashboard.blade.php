@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>管理ダッシュボード</h1>
    <p>管理対象の一覧ページに移動できます。</p>

    <ul>
        <li><a href="{{ route('admin.questions.index') }}">質問管理一覧へ</a></li>
        <li><a href="{{ route('admin.answers.index') }}">回答管理一覧へ</a></li>
        <li><a href="{{ route('admin.users.index') }}">ユーザー管理一覧へ</a></li>
    </ul>
</div>
@endsection
