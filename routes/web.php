<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Calculator;


// 
Route::get('/', function () {
    return view('home');
});
Route::get('/balance', function () {
    return view('balance');
});



// Actions
Route::post('/calculate', [Calculator::class, 'FullCalculation']) -> name('calculate.full');