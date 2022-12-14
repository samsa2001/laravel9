<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\PostController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\web\BlogController;
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
})->name('welcome');
Route::get('/vue/{rutaDeVue?}', function () {
    return view('vue');
})->name('vue.post');



require __DIR__.'/auth.php';

Route::get('/backend', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::group(['prefix' => 'backend', 'middleware' => ['auth','admin']],function(){
    Route::resources([
        'post' => PostController::class,
        'category' => CategoryController::class,
        'user' => UserController::class
    ]);
});


Route::group(['prefix' => 'blog'], function () {
    Route::controller(BlogController::class)->group(function(){
        Route::get('/', "index")->name("web.post.index");
        Route::get('/{post}', "show")->name("web.post.show");
    });
});

// contacto
Route::view('/contacto', 'web.contacto')->name('web.contacto');
Route::post('/send-contact','App\Http\Controllers\Web\ContactController@send')->name('web.send.contacto');
