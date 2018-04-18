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

Route::middleware(['auth'])->group(function() {
    Route::get('/', 'Home\\HomeController@index')->name('home');
    Route::get('/lernzentrum', 'Home\\LernzentrumController@index')->name('lernzentrum');
    Route::get('/lernzentrum/{lernzentrum}', 'Home\\LernzentrumController@detail')->name('lernzentrum.detail');
});

Auth::routes();

Route::get('/auth/activate', 'Auth\\ActivationController@activate')->name('auth.activate');
