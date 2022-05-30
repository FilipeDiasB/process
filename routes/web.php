<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;

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

Route::view('/dashboard', 'dashboard')->middleware(['auth'])->name('dashboard');


Route::group(['middleware' => 'CheckType:master', 'prefix' => 'master'], function(){
    Route::resource('usuario', UserController::class);
});


require __DIR__.'/auth.php';
