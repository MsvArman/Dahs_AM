<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagement;
use App\Http\Controllers\CustomerManagement;
use App\Http\Controllers\CallHistory;
use App\Http\Controllers\login;
use App\Http\Controllers\caller;
use App\Http\Controllers\RoleController;

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

Route::get('/', function () { return view('main');})->name('main')->middleware("auth");
Route::get('/login', function () {return view('login');})->name('login');
Route::get('/logout', [App\Http\Controllers\login::class, 'logout'])->name('logout');


Route::post('/userlogin', [App\Http\Controllers\login::class, 'user_login'])->name('user_login');
// users
Route::get('/usermanagement', [App\Http\Controllers\UserManagement::class, 'Show_Users'])->name('usermanagement')->middleware("auth");
Route::get('/createuser', function () {return view('CreateUser');})->name('createuser')->middleware("auth");
Route::post('/Create_User', [App\Http\Controllers\UserManagement::class, 'Create_User'])->name('cr');
Route::get('/Del_User', [App\Http\Controllers\UserManagement::class, 'destroy'])->name('dr');
Route::get('/updateuser', [App\Http\Controllers\UserManagement::class, 'Show_User'])->name('ur_show')->middleware("auth");
Route::post('/Update_User', [App\Http\Controllers\UserManagement::class, 'Update_User'])->name('ur');

// Customer
Route::get('/customermanagement', [App\Http\Controllers\CustomerManagement::class, 'Show_Customers'])->name('customermanagement')->middleware("auth");
Route::get('/createcustomer', function () {return view('CreateCustomer');})->name('createcustomer')->middleware("auth");
Route::post('/Create_Customer', [App\Http\Controllers\CustomerManagement::class, 'Create_Customer'])->name('ccr');
Route::get('/Del_Customer', [App\Http\Controllers\CustomerManagement::class, 'destroy'])->name('dcr');
Route::get('/updatecustomer', [App\Http\Controllers\CustomerManagement::class, 'Show_Customer'])->name('ucr_show')->middleware("auth");
Route::post('/Update_Customer', [App\Http\Controllers\CustomerManagement::class, 'Update_Customer'])->name('ucr');

Route::get('/callhistory', [App\Http\Controllers\CallHistory::class, 'Show_Calls'])->name('callhistory')->middleware("auth");
Route::get('/profilecustomer', [App\Http\Controllers\CallHistory::class, 'Profile_Customer'])->name('pc')->middleware("auth");
Route::post('/updatecomment', [App\Http\Controllers\CallHistory::class, 'Comment'])->name('updatecomment');
Route::post('/updatecalls', [App\Http\Controllers\CallHistory::class, 'Update_Calls'])->name('updatecalls');

Route::post('/caller', [App\Http\Controllers\caller::class, 'caller'])->name('caller');
Route::post("/submit_message", [MessageController::class , "submit_message"])->name("submit_message");
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'Show_Roles'])->name('roles')->middleware("auth");
Route::post('/createrole', [App\Http\Controllers\RoleController::class, 'Create_Role'])->name('createrole');
Route::post('/delrole', [App\Http\Controllers\RoleController::class, 'Del_Role'])->name('delrole');

Route::get("/reports", [ReportsController::class, "show"])->name("reports_show")->middleware("auth");
Route::post("/give_report", [ReportsController::class, "give_report"])->name("give_report")->middleware("auth");
