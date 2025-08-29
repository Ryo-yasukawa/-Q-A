@extends('layouts.app')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="container">
    <h2>自分の回答一覧</h2>

    @if ($answers->count())
        <ul class="list-group">
            @foreach ($answers as $answer)
                <li class="list-group-item">
                    {{-- 回答本文にリンクをつける --}}
                    <a href="{{ route('mypage.answers.show', $answer->id) }}">
                        {{ Str::limit($answer->body, 100) }} {{-- 先頭100文字を表示 --}}
                    </a>
                    <small class="text-muted d-block">
                        回答日時: {{ $answer->created_at->format('Y-m-d') }}
                    </small>
                </li>
            @endforeach
        </ul>
        <div class="mt-3">
            {{ $answers->links() }}
        </div>
    @else
        <p>まだ回答はありません。</p>
    @endif
</div>
@endsection


