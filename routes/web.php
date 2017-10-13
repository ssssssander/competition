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

Route::get('/', 'PageController@index')->name('index');

Route::get('/participate', 'PageController@participate')->name('participate');

Route::post('/participate/store', 'PageController@store_participant')->name('store_participant');

Route::get('/dashboard', 'PageController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/winners', 'PageController@winners')->name('winners');

Route::get('/logout', 'PageController@logout')->name('logout');

Route::get('/home', 'PageController@home')->name('home');


// Auth::routes() but without registration routes

// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('password/reset', 'Auth\ResetPasswordController@reset');
