<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/','dashboard');

Auth::routes(['register'=>false]);


Route::middleware(["auth"])->namespace("Dashboard")->prefix("dashboard")->group(function() 
{

    Route::get('','DashboardController@index')->name('dashboard');

    Route::get('company/index','CompanyController@index')->name('company.index');
    Route::get('company/create','CompanyController@create')->name('company.create');
    Route::get('company/edit/{id}','CompanyController@edit')->name('company.edit');
    Route::post('company/store','CompanyController@store')->name('company.store');
    Route::post('company/update','CompanyController@update')->name('company.update');
    Route::get('company/remove/{id}','CompanyController@remove')->name('company.remove');

    Route::get('settings/index','CompanyController@settingsEdit')->name('settings.edit');
    Route::post('settings/update','CompanyController@settingsUpdate')->name('settings.update');

    Route::get('product/index','ProductController@index')->name('product.index');
    Route::get('product/create','ProductController@create')->name('product.create');
    Route::get('product/edit/{id}','ProductController@edit')->name('product.edit');
    Route::post('product/store','ProductController@store')->name('product.store');
    Route::post('product/update','ProductController@update')->name('product.update');
    Route::get('product/remove/{id}','ProductController@remove')->name('product.remove');

    Route::get('image/remove/{id}','ProductController@removeImage')->name('image.remove');
    



    Route::get('user/index','UserController@index')->name('user.index');
    Route::get('user/create','UserController@create')->name('user.create');
    Route::post('user/store','UserController@store')->name('user.store');
    Route::post('user/update','UserController@update')->name('user.update');
    
    Route::get('user/edit/{id}','UserController@edit')->name('user.edit');
    Route::get('user/remove{id}','UserController@remove')->name('user.remove');

});
