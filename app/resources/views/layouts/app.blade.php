<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS（CDNで読み込み） -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- 自作CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <!-- ナビバー -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    Q&A
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
                        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- 左側のメニュー -->
                    <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">ホーム</a> -->
                        </li>
                    </ul>

                    <!-- 右側のメニュー -->
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">登録</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="{{ route('mypage') }}">マイページ</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            ログアウト
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- メインコンテンツ -->
        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS（CDNで読み込み） -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery CDN（Ajax用） -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on('click', '.bookmark-btn', function () {
    const button = $(this);
    const questionId = button.data('question-id');
    // data-bookmarked を文字列でも boolean でも正しく判定
    const isBookmarked = button.data('bookmarked') === true || button.data('bookmarked') === 'true';

    $.ajax({
        url: `/questions/${questionId}/bookmark`,
        type: 'POST', // DELETEの場合もPOST + _method で送信
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            _method: isBookmarked ? 'DELETE' : 'POST'
        },
        success: function (res) {
            if (isBookmarked) {
                button
                    .text('☆ ブックマーク')
                    .removeClass('btn-warning')
                    .addClass('btn-outline-warning')
                    .data('bookmarked', false);
            } else {
                button
                    .text('★ ブックマーク解除')
                    .removeClass('btn-outline-warning')
                    .addClass('btn-warning')
                    .data('bookmarked', true);
            }
        },
        error: function (xhr) {
            alert('処理に失敗しました');
            console.error(xhr.responseText);
        }
    });
});
</script>


</body>
</html>
