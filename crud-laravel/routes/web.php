<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\AccountController;
use App\Models\AddSchedule;
use Illuminate\Support\Facades\Auth;

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/registrasi', function () {
    return view('registrasi');
})->name('registrasi');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $schedules = AddSchedule::where('user_id', Auth::id())->get();
        return view('dashboard', compact('schedules'));
    })->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/matkul/store', [MataKuliahController::class, 'store'])->name('matkul.store');
    Route::delete('/matkul/{id}', [MataKuliahController::class, 'destroy'])->name('matkul.destroy');

    Route::get('/add-schedule', [ScheduleController::class, 'create'])->name('addSchedule');
    Route::post('/add-schedule', [ScheduleController::class, 'store'])->name('addSchedule.store');

    Route::post('/schedule/{id}/done', [ScheduleController::class, 'markAsDone'])->name('schedule.done');

    Route::get('/history', function () {
        return view('history');
    })->name('history');

    Route::get('/history', [HistoryController::class, 'index'])->name('history');
    Route::delete('/history/{id}', [HistoryController::class, 'destroy'])->name('history.delete');

    Route::get('/account', function () {
        return view('account');
    })->name('account');

    Route::get('/account', [AccountController::class, 'show'])->name('account');
    Route::post('/account/update', [AccountController::class, 'update'])->name('account.update');
});
