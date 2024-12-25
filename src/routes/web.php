<?php

use App\Http\Controllers\StreetController;
use Illuminate\Support\Facades\Route;
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [StreetController::class, 'index'])->name('streets');

//Route::apiResource()
