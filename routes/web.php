<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [BidController::class, 'index'])->name('dashboard');

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::post('/dashboard', [BidController::class, 'show'])->name('search');
    Route::get('/bids/edit/{id}', [BidController::class, 'edit'])->name('edit');
    Route::post('/bids/edit/{id}', [BidController::class, 'update'])->name('update');
    Route::get('/dashboard/delete/{id}', [BidController::class, 'destroy'])->name('delete');
});
Route::post('/post', [BidController::class, 'create'])->name('post');
require __DIR__ . '/auth.php';


