<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\RestController;
use App\Http\Controllers\AttendanceController;



// 新規登録
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

// ログイン
Route::get('/login',[AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// ログアウト
Route::post('/logout',[AuthenticatedSessionController::class, 'destroy'])->middleware('auth');

Route::middleware(['auth'])->group(function(){
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
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// require __DIR__.'/auth.php';
