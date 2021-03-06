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


Route::get('/', ['as' => "login", 'uses' => 'ContactsController@index']);

Route::resource('contacts', 'ContactsController');
Route::get('/contacts/{id}/delete', ['as' => "delete-contact", 'uses' => 'ContactsController@destroy']);

Route::get('/user/sendWelcome', ['as' => "welcome-email", 'uses' => 'EmailController@welcomeEmail']);
Route::get('/testMail', 'ContactsController@testMail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
