<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'index'])->name('main');
Route::post('/registration', [UserController::class, 'registration'])->name('registration');
Route::get('/link', [UserController::class, 'link'])->name('link');
Route::get('/page/{token}', [PageController::class, 'showPage'])->name('pageA');
Route::post('/page/generate', [PageController::class, 'generateNewLinkAction'])->name('generateNewLink');
Route::post('/page/deactivate', [PageController::class, 'deactivateLinkAction'])->name('deactivateLink');
Route::post('/page/lottery', [PageController::class, 'imfeelingLuckyAction'])->name('lottery');
Route::post('/page/history', [PageController::class, 'historyAction'])->name('history');

