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

    // Lernzentrum
    Route::get('/lernzentrum', 'Home\\LernzentrumController@index')->name('lernzentrum');
    Route::get('/lernzentrum/{lernzentrum}', 'Home\\LernzentrumController@detail')->name('lernzentrum.detail');

    // Account
    Route::group(['namespace' => 'account', 'prefix' => 'account'], function() {
        Route::get('/', 'AccountController@index')->name('account');

        // Profile
        Route::get('/profile', 'ProfileController@index')->name('account.profile');
        Route::patch('/profile', 'ProfileController@update')->name('account.profile.update');

        // Password
        Route::get('/password', 'PasswordController@index')->name('account.password');
        Route::patch('/password', 'PasswordController@update')->name('account.password.update');
    });
});

// Auth
Auth::routes();

Route::get('/auth/activate', 'Auth\\ActivationController@activate')->name('auth.activate');
