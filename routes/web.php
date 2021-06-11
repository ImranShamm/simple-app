<?php

use App\Http\Controllers\CompaniesController;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Companies
// Route::get('companies/',[CompaniesController::class, 'index'])->name('companies.show');
Route::get('companies/create', 'CompaniesController@create');
Route::post('companies/store', 'CompaniesController@store');
Route::put('companies/update', 'CompaniesController@update');
Route::get('companies/{id}/destroy', 'CompaniesController@destroy');
Route::resource('companies', 'CompaniesController');

