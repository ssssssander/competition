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

Route::get('/', 'IndexController@index')->name('index');

Route::get('/home', 'IndexController@home')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');

    Route::delete('/dashboard/delete_participant/{participant}', 'ParticipantController@delete_participant')->name('delete_participant');

    Route::get('/dashboard/terms', 'TermController@terms')->name('terms');

    Route::post('/dashboard/terms/edit_terms', 'TermController@edit_terms')->name('edit_terms');

    Route::post('/dashboard/export_participants', 'ParticipantController@export_participants')->name('export_participants');

    Route::delete('/dashboard/reset', 'DashboardController@reset')->name('reset');
});

Route::middleware(['ongoing'])->group(function () {
    Route::get('/vote', 'VoteController@vote')->name('vote');

    Route::post('/vote/increment_vote/{participant}', 'VoteController@increment_vote')->name('increment_vote');

    Route::get('/participate', 'ParticipantController@participate')->name('participate');

    Route::post('/participate/store_participant', 'ParticipantController@store_participant')->name('store_participant');
});

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
