<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Main Page Route

Route::get('/login', [LoginBasic::class, 'index'])
  ->middleware('guest')
  ->name('login');

Route::middleware(['auth'])->group(function () {
  Route::get('/', [HomePage::class, 'index'])->name('pages-home');
  Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// locale
  Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// pages
  Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
});

Route::middleware(['guest'])->group(function () {
// authentication
  Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
  Route::post('/auth/login-basic', [LoginBasic::class, 'login'])->name('auth-login');

  Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
  Route::post('/auth/register-basic', [RegisterBasic::class, 'register'])->name('auth-register');
  Route::get('/auth/confirm/{token}', [RegisterBasic::class, 'confirm'])->name('auth-confirm');
});


