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


Route::get('/', ['as' => "login", 'uses' => 'AuthController@indexLogin']);
Route::get('/contacts/create', ['as' => "contacts-form", 'uses' => 'ContactsController@contactForm']);
Route::get('/contacts/{id}', ['as' => "contacts-user", 'uses' => 'ContactsController@getUserContacts']);
Route::post('/contacts', ['as' => "store-contact", 'uses' => 'ContactsController@registerContact']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
