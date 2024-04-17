<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;


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
Route::get('/country', [CountryController::class, 'index'])->name('country');
Route::post('/country', [CountryController::class, 'store'])->name('countries.store');
Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('countries.edit');
Route::put('/countries/update/{id}', [CountryController::class, 'update'])->name('countries.update');
Route::delete('/countries/delete/{id}', [CountryController::class, 'destroy'])->name('countries.destroy');
