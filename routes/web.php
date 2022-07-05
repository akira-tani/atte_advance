<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;

// 新規登録
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

// ログイン
Route::get('/login',[AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// ログアウト
Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware(['auth', 'verified'])->group(function(){
  // 打刻ページ
  Route::get('/', [StampController::class, 'index']);

  // 勤怠ボタン
  Route::post('/work-start', [WorkController::class, 'start']);
  Route::post('/work-end', [WorkController::class, 'end']);

  // 休憩ボタン
  Route::post('/rest-start', [RestController::class, 'start']);
  Route::post('/rest-end', [RestController::class, 'end']);

  // 日付別勤怠ページ
  Route::get('/attendance', [AttendanceController::class, 'index']);
  Route::post('/attendance', [AttendanceController::class, 'changeDate']);

  Route::get('/user', [RegisteredUserController::class, 'index']);
  Route::post('/user_attendance', [AttendanceController::class, 'getUser']);
});

Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
            ->name('verification.notice');
Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');
Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
