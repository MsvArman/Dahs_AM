<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement;
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

Route::get('/', function () {
    return view('main');
});

Route::get('/usermanagement', [App\Http\Controllers\UserManagement::class, 'Show_Users']);
Route::get('/createuser', function () {return view('CreateUser');})->name('createuser');
Route::post('/Create_User', [App\Http\Controllers\UserManagement::class, 'Create_User'])->name('cr');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
