@extends('layouts.app')

@section('content')
<div class="container">
    <h2>退会が完了しました。</h2>
    <p>ご利用ありがとうございました。</p>
    <p>またのご利用お待ちしております。</p>
    <a href="{{ route('home') }}" class="btn btn-primary">トップページへ</a>
</div>
@endsection
