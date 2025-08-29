<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\QuestionController as MypageQuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\AdminAnswerController;
use App\Http\Controllers\AdminUserController;

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

    // ===== 投稿履歴 =====
    Route::get('/mypage/questions', [QuestionController::class, 'myQuestions'])->name('mypage.questions');  // 自分の質問一覧
    Route::get('/mypage/questions/{id}', [QuestionController::class, 'myQuestionShow'])->name('mypage.questions.show'); // 自分の質問詳細

    Route::get('/mypage/answers', [AnswerController::class, 'myAnswers'])->name('mypage.answers'); // 自分の回答一覧
    Route::get('/mypage/answers/{id}', [AnswerController::class, 'myAnswerShow'])->name('mypage.answers.show'); // 自分の回答詳細

    Route::get('/mypage/bookmarks', [MyPageController::class, 'myBookmarks'])->name('mypage.bookmarks');

    // ===== 質問関連 =====
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

    // 編集・削除（自分の質問のみ）
    Route::get('/mypage/questions/{id}/edit', [QuestionController::class, 'edit'])->name('mypage.questions.edit');
    Route::put('/mypage/questions/{id}', [QuestionController::class, 'update'])->name('mypage.questions.update');
    Route::delete('/mypage/questions/{id}', [QuestionController::class, 'destroy'])->name('mypage.questions.destroy');

    // ===== 回答関連 =====
    Route::get('/questions/{question}/answers/create', [AnswerController::class, 'create'])->name('answers.create');
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');

    // 編集・削除（自分の回答のみ）
    Route::get('/mypage/answers/{id}/edit', [AnswerController::class, 'edit'])->name('mypage.answers.edit');
    Route::put('/mypage/answers/{id}', [AnswerController::class, 'update'])->name('mypage.answers.update');
    Route::delete('/mypage/answers/{id}', [AnswerController::class, 'destroy'])->name('mypage.answers.destroy');

    // ===== 通報・コメント =====
    Route::post('/questions/{question}/report', [ReportController::class, 'reportQuestion'])->name('questions.report');
    Route::post('/answers/{answer}/comments', [CommentController::class, 'store'])->name('comments.store');

    // ===== ブックマーク =====
    Route::post('/questions/{id}/bookmark', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/questions/{id}/bookmark', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

    
});

     Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // 管理者ダッシュボード
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // 質問管理
    Route::get('/questions', [AdminQuestionController::class, 'index'])->name('admin.questions.index');            
    Route::get('/questions/{id}', [AdminQuestionController::class, 'show'])->name('admin.questions.show');          
    Route::get('/questions/{id}/edit', [AdminQuestionController::class, 'edit'])->name('admin.questions.edit');     
    Route::put('/questions/{id}', [AdminQuestionController::class, 'update'])->name('admin.questions.update');   
    
    // 回答管理
    Route::get('/answers', [AdminAnswerController::class, 'index'])->name('admin.answers.index');           
    Route::get('/answers/{id}', [AdminAnswerController::class, 'show'])->name('admin.answers.show');         
    Route::get('/answers/{id}/edit', [AdminAnswerController::class, 'edit'])->name('admin.answers.edit');    
    Route::put('/answers/{id}', [AdminAnswerController::class, 'update'])->name('admin.answers.update');    
    
    // ユーザー管理
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');           
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');         
    Route::get('/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');    
    Route::put('/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');     
  
});

     Route::get('/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');
   