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
    Route::group(['namespace' => 'Account', 'prefix' => 'account', 'as' => 'account.'], function() {
        Route::get('/', 'AccountController@index')->name('index');

        // Profile
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::patch('/profile', 'ProfileController@update')->name('profile.update');

        // Password
        Route::get('/password', 'PasswordController@index')->name('password');
        Route::patch('/password', 'PasswordController@update')->name('password.update');

        //Angebot
        Route::model('angebote', 'App\\Angebot');
        Route::resource('/angebote', 'AngebotController', ['except' => 'show']);

        // Lernzentrum
        Route::get('/lernzentrum', 'LernzentrumController@index')->name('lernzentrum');
        Route::get('/lernzentrum/support', 'LernzentrumSupportController@index')->name('lernzentrum.support');
    });
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {

    // Lehrer Bereich
    Route::middleware(['auth', 'role:lehrer,admin'])->group(function() {
        // Users
        Route::get('/users', 'UserController@index')->name('users');

        // Lernzentrum
        Route::resource('/lernzentrum', 'LernzentrumController');

        // Angebot
        Route::resource('/angebote', 'AngebotController');

        // Topics
        Route::get('/topics', 'TopicController@index')->name('topics');

        // Subjects
        Route::get('/subjects', 'SubjectController@index')->name('subjects');
    });
});

// Datatable Resources
Route::group(['namespace' => 'DataTable', 'prefix' => 'datatable', 'as' => 'datatable.'], function() {

    // Add Middleware for Admin and Lehrer
    Route::middleware(['auth', 'role:lehrer,admin'])->group(function() {
        // Users
        Route::resource('/users', 'UserController');

        // Topics
        Route::resource('/topics', 'TopicController');

        // Subjects
        Route::resource('/subjects', 'SubjectController');
    });
});

// WebApi
Route::group(['middleware' => 'auth', 'namespace' => 'Api', 'prefix' => 'webapi', 'as' => 'api.'], function() {
    Route::get('/topics', 'TopicController@index')->name('topic');
    Route::get('/subjects', 'SubjectController@index')->name('subject');
    Route::get('/search', 'SearchController@index')->name('search');
});

// Auth
Auth::routes();

// Activation Route
Route::get('/auth/activate', 'Auth\\ActivationController@activate')->name('auth.activate');
