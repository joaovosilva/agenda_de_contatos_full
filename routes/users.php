<?php

use Illuminate\Support\Facades\Route;

Route::post('register', 'UsersController@registerUser');
Route::get('getAll', 'UsersController@getAllUsers');
Route::get('getUser/{user_id}', 'UsersController@getUserById');
