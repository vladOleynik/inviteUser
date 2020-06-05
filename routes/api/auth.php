<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'LoginController@login')->name('login');
