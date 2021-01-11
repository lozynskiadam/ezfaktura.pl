<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\TemplateController;
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

Route::get('/language/{locale}', function($locale) {
   session(['locale' => $locale]);
   return redirect()->route('home');
});

Route::group(['domain' => env('APP_URL')], function() {
    Route::any('/', function(){
        return view('pages.home.index');
    });
});

Route::group(['domain' => env('APP_PANEL_URL')], function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::group(['middleware' => 'auth'], function () {
        Route::any('/', [InvoiceController::class, 'index'])->name('home');
        Route::any('/logout', [LogoutController::class, 'index'])->name('logout');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::resource('invoices', InvoiceController::class, ['only' => ['index']]);
        Route::resource('signatures', SignatureController::class, ['except' => ['show']]);
        Route::get('/templates/list', [TemplateController::class, 'list'])->name('templates/list');
        Route::get('/api', [ApiController::class, 'index'])->name('api');
        Route::post('/api/resetkey', [ApiController::class, 'resetKey']);
        Route::get('/notifications/list', [NotificationController::class, 'list']);
    });
});

Route::group(['domain' => env('APP_API_URL')], function() {

});