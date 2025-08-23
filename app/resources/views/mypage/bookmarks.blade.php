@extends('layouts.app')

@section('content')
<div class="container">
    <h2>ブックマーク一覧</h2>

    @if ($bookmarks->count())
        <ul class="list-group">
            @foreach ($bookmarks as $bookmark)
                <li class="list-group-item">
                    <a href="{{ route('questions.show', $bookmark->question->id) }}">
                        {{ $bookmark->question->title }}
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="mt-3">
            {{ $bookmarks->links() }}
        </div>
    @else
        <p>まだブックマークはありません。</p>
    @endif
</div>
@endsection
