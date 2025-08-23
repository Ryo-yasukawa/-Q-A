<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [HomeController::class,'index'])->name('home');
Route::middleware('auth')->group(function() {
    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');

    // プロフィール編集
    Route::get('/mypage/edit', [MyPageController::class, 'edit'])->name('mypage.edit');
    Route::post('/mypage/update', [MyPageController::class, 'update'])->name('mypage.update');

    Route::get('/mypage/withdraw/confirm', [MyPageController::class, 'withdrawConfirm'])->name('mypage.withdraw.confirm');
    Route::delete('/mypage/withdraw', [MyPageController::class, 'withdraw'])->name('mypage.withdraw');
    Route::get('/mypage/withdraw/complete', [MyPageController::class, 'withdrawComplete'])->name('mypage.withdraw.complete');

    // 投稿履歴
    Route::get('/mypage/questions', [MyPageController::class, 'myQuestions'])->name('mypage.questions');
    Route::get('/mypage/answers', [MyPageController::class, 'myAnswers'])->name('mypage.answers');
    Route::get('/mypage/bookmarks', [MyPageController::class, 'myBookmarks'])->name('mypage.bookmarks');
});
