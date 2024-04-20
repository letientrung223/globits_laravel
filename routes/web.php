<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoleController;


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
//COUNTRY
Route::get('/country', [CountryController::class, 'index'])->name('country');
Route::post('/country', [CountryController::class, 'store'])->name('countries.store');
Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('countries.edit');
Route::put('/countries/update/{id}', [CountryController::class, 'update'])->name('countries.update');
Route::delete('/countries/delete/{id}', [CountryController::class, 'destroy'])->name('countries.destroy');

// PERSON
Route::get('/person', [PersonController::class, 'index'])->name('persons');
Route::post('/person', [PersonController::class, 'store'])->name('persons.store');
Route::get('/person/edit/{id}', [PersonController::class, 'edit'])->name('persons.edit');
Route::put('/person/update/{id}', [PersonController::class, 'update'])->name('persons.update');
Route::delete('/person/delete/{id}', [PersonController::class, 'destroy'])->name('persons.destroy');

//USER
Route::get('/user', [UserController::class, 'index'])->name('users');
Route::post('/user', [UserController::class, 'store'])->name('users.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//COMPANY
Route::get('/company', [CompanyController::class, 'index'])->name('companies');
Route::post('/company', [CompanyController::class, 'store'])->name('companies.store');
Route::get('/company/edit/{id}', [CompanyController::class, 'edit'])->name('companies.edit');
Route::put('/company/update/{id}', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('/company/delete/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');

//ROLE
Route::get('/role', [RoleController::class, 'index'])->name('roles');
Route::post('/role', [RoleController::class, 'store'])->name('roles.store');
Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/role/update/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/role/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');