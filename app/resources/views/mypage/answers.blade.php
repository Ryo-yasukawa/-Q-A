@extends('layouts.app')

@section('content')
<div class="container">
    <h2>自分の回答一覧</h2>

    @if ($answers->count())
        <ul class="list-group">
            @foreach ($answers as $answer)
                <li class="list-group-item">
                    <p>{{ Str::limit($answer->content, 100) }}</p>
                    <small class="text-muted">
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
