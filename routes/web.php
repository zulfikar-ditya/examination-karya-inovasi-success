<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\StoriesController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/stories/{slug}', [HomeController::class, 'detail_stories'])->name('detail-stories');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'view_login'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    
    Route::get('/register', [AuthController::class, 'view_register'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});




Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'home'])->name('home');

    Route::resource('my-stories', StoriesController::class);

    Route::middleware('admin')->namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resources([
            'category' => CategoryController::class,
            'role' => RoleController::class,
            'permission' => PermissionController::class,
            'user' => UserController::class,
            'stories' => StoriesController::class,
        ]);
    });
});
