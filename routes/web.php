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
    Route::post('/lernzentrum/{lernzentrum}/signup', 'Home\\LernzentrumController@signup')->name('lernzentrum.signup');
    Route::post('/lernzentrum/{lernzentrum}/signout', 'Home\\LernzentrumController@signout')->name('lernzentrum.signout');

    // UserProfile
    Route::get('/users/{user}', 'Home\\UserController@detail')->name('user.detail');
    Route::post('/users/{user}', 'Home\\UserController@store')->name('user.store');

    // Account
    Route::group(['namespace' => 'account', 'prefix' => 'account'], function() {
        Route::get('/', 'AccountController@index')->name('account');

        // Profile
        Route::get('/profile', 'ProfileController@index')->name('account.profile');
        Route::patch('/profile', 'ProfileController@update')->name('account.profile.update');

        // Password
        Route::get('/password', 'PasswordController@index')->name('account.password');
        Route::patch('/password', 'PasswordController@update')->name('account.password.update');

        // Lernzentrum
        Route::get('/lernzentrum', 'LernzentrumController@index')->name('account.lernzentrum');
        Route::get('/lernzentrum/support', 'LernzentrumSupportController@index')->name('account.lernzentrum.support');
    });
});

Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {

    // Lehrer Bereich
    Route::middleware(['auth', 'role:lehrer,admin'])->group(function() {

        // Lernzentrum
        Route::resource('/lernzentrum', 'LernzentrumController');

        // Topics
        Route::get('/topics', 'TopicController@index');

        // Subjects
        Route::get('/subjects', 'SubjectController@index');
    });
});

// Datatable Rescources
Route::group(['namespace' => 'datatable', 'prefix' => 'datatable', 'as' => 'datatable.'], function() {

    // Add Middleware for Admin and Lehrer
    Route::middleware(['auth', 'role:lehrer,admin'])->group(function() {

        // Topics
        Route::resource('/topics', 'TopicController');

        // Subjects
        Route::resource('/subjects', 'SubjectController');
    });
});

// WebApi
Route::group(['middleware' => 'auth', 'namespace' => 'api', 'prefix' => 'webapi', 'as' => 'api.'], function() {
    Route::get('/topics', 'TopicController@index')->name('topic');
    Route::get('/subjects', 'SubjectController@index')->name('subject');
    Route::get('/search', 'SearchController@index')->name('search');
});

Route::resource('datatable/users', 'DataTable\UserController');

Route::get('/admin/users', 'Admin\UserController@index');

Route::get('/admin', 'Admin\AdminController@index');

// Auth
Auth::routes();

Route::get('/auth/activate', 'Auth\\ActivationController@activate')->name('auth.activate');
