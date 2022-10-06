<?php

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

Auth::routes();

Route::get('/', 'UserController@dashboard')->name('home');
Route::get('/home', 'UserController@dashboard')->name('home');

Route::get('users/search/{q}', ['as' => 'users.search', 'uses' => 'UserController@search']);
Route::resource('users', 'UserController');

Route::get('banks/search/{q}', ['as' => 'banks.search', 'banks' => 'BankController@search']);
Route::resource('banks', 'BankController');
