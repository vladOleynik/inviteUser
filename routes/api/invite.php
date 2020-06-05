<?php

use Illuminate\Support\Facades\Route;

Route::post('invite', 'InviteController@createInvite')->name('create');
