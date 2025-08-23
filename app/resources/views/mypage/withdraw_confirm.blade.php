@extends('layouts.app')

@section('content')
<div class="container">
    <h2>退会確認</h2>
    <p>本当に退会してもよろしいですか？</p>

    <form action="{{ route('mypage.withdraw') }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">退会する</button>
        <a href="{{ route('mypage') }}" class="btn btn-secondary">キャンセル</a>
    </form>
</div>
@endsection
