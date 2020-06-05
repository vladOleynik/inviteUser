<?php

use Illuminate\Support\Facades\Route;

Route::get('test12', function (){
    echo 2;
})->name('get');
