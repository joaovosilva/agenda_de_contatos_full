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
Auth::routes();
Route::get('/contacts/{id}', ['as' => "contacts.user", 'uses' => 'ContactsController@getUserContacts']);
Route::get('/contacts/{id}/form', ['as' => "contacts.form", 'uses' => 'ContactsController@contactForm']);
