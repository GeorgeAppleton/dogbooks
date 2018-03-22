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

Route::get('/', 'BoardingBookingController@index')->name('home');

Route::match(['get', 'post'], '/new', 'NewDataController@index')->name('newData');

Route::get('/profile/{model}/{id}', 'ProfileController@index')->name('profile');
