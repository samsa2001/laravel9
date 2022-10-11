<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\PostController;
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
    return view('welcome');
});



require __DIR__.'/auth.php';

Route::group(['prefix' => 'backend', 'middleware' => 'auth'],function(){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resources([
        'post' => PostController::class,
        'category' => CategoryController::class
    ]);
});
