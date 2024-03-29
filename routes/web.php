<?php

use App\Http\Controllers\ShortLinkController;
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

Route::get('/', function () {
  return to_route('shortlink.index');
});

Route::get('/generate-shorten-link', [ShortLinkController::class, 'index'])->name('shortlink.index');
Route::post('/generate-shorten-link', [ShortLinkController::class, 'store'])->name('shortlink.store');
Route::get('/{code}', [ShortLinkController::class, 'shortLink'])->name('shortlink.link');
