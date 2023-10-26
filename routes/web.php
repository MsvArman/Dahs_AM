<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\CustomerManagement;
use App\Http\Controllers\CallHistory;
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



// users
Route::get('/usermanagement', [App\Http\Controllers\UserManagement::class, 'Show_Users'])->name('usermanagement');
Route::get('/createuser', function () {return view('CreateUser');})->name('createuser');
Route::post('/Create_User', [App\Http\Controllers\UserManagement::class, 'Create_User'])->name('cr');
Route::get('/Del_User', [App\Http\Controllers\UserManagement::class, 'destroy'])->name('dr');
Route::get('/updateuser', [App\Http\Controllers\UserManagement::class, 'Show_User'])->name('ur_show');
Route::post('/Update_User', [App\Http\Controllers\UserManagement::class, 'Update_User'])->name('ur');

// Customer
Route::get('/customermanagement', [App\Http\Controllers\CustomerManagement::class, 'Show_Customers'])->name('customermanagement');
Route::get('/createcustomer', function () {return view('CreateCustomer');})->name('createcustomer');
Route::post('/Create_Customer', [App\Http\Controllers\CustomerManagement::class, 'Create_Customer'])->name('ccr');
Route::get('/Del_Customer', [App\Http\Controllers\CustomerManagement::class, 'destroy'])->name('dcr');
Route::get('/updatecustomer', [App\Http\Controllers\CustomerManagement::class, 'Show_Customer'])->name('ucr_show');
Route::post('/Update_Customer', [App\Http\Controllers\CustomerManagement::class, 'Update_Customer'])->name('ucr');

Route::get('/callhistory', [App\Http\Controllers\CallHistory::class, 'Show_Calls'])->name('callhistory');
Route::get('/profilecustomer', [App\Http\Controllers\CallHistory::class, 'Profile_Customer'])->name('pc');



Route::post("/submit_message", [MessageController::class , "submit_message"])->name("submit_message");

// Route::get("/reports", [])
