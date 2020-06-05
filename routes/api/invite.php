<?php

use Illuminate\Support\Facades\Route;

Route::post('invite', 'InviteController@createInvite')->name('create');
Route::get('invite', 'InviteController@getInvitesForUser')->name('get');
Route::put('invite', 'InviteController@setStatusInvite')->name('update');


