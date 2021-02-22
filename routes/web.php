<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\GUSController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

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

Route::get('/language/{locale}', function ($locale) {
    session(['locale' => $locale]);
    return redirect()->route('home');
});

Route::group(['domain' => env('APP_URL')], function () {
    Route::any('/', function () {
        return view('pages.home.index');
    });
    Route::post('/contact', function () {
        return response()->json(true);
    });
});

Route::group(['domain' => env('APP_PANEL_URL')], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::group(['middleware' => 'auth'], function () {
        Route::any('/', [InvoiceController::class, 'index'])->name('home');
        Route::any('/logout', [LogoutController::class, 'index'])->name('logout');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/logo', [ProfileController::class, 'update_logo'])->name('profile.update_logo');
        Route::get('/profile/changepassword', function() { return view('pages.profile.dialogs.change_password'); });
        Route::post('/profile/changepassword', [ProfileController::class, 'change_password']);
        Route::post('/profile/delete', [ProfileController::class, 'delete_profile'])->name('profile.delete_profile');
        Route::resource('invoices', InvoiceController::class, ['except' => ['edit', 'update']]);
        Route::get('/invoices/{invoice}/download', [InvoiceController::class, 'download'])->name('invoice.download');
        Route::resource('signatures', SignatureController::class, ['except' => ['show']]);
        Route::get('/reports', [ReportController::class, 'index']);
        Route::get('/reports/{report}/generate', [ReportController::class, 'generate']);
        Route::get('/template', [TemplateController::class, 'index'])->name('template.index');
        Route::get('/template/preview', [TemplateController::class, 'preview'])->name('template.preview');
        Route::get('/api', [ApiController::class, 'index'])->name('api');
        Route::post('/api/resetkey', [ApiController::class, 'reset_key']);
        Route::get('/notifications/list', [NotificationController::class, 'list']);
        Route::get('/search', [SearchController::class, 'search'])->name('search');
        Route::get('/gus', [GUSController::class, 'search'])->name('gus');
    });
});

Route::group(['domain' => env('APP_API_URL')], function () {

});
