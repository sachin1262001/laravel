<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Students;
use App\Http\Controllers\EmployeeData;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('products', ProductController::class);

Route::resource('students', Students::class);

// Route::resource('login', EmployeeData::class);
Route::get('dashboard', [EmployeeData::class, 'dashboard']); 
Route::get('login', [EmployeeData::class, 'index'])->name('login');
Route::post('custom-login', [EmployeeData::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [EmployeeData::class, 'registration'])->name('register-user');
Route::post('custom-registration', [EmployeeData::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [EmployeeData::class, 'signOut'])->name('signout');