<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Calculator;


// 
Route::get('/', function () {
    return view('home');
});



// Actions
Route::post('/calculate', [Calculator::class, 'FullCalculation']) -> name('calculate.full');