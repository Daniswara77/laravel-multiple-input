<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController;

Route::get('/', function(){
	return redirect('/laptop');
});

Route::resource('/laptop', LaptopController::class);
Route::delete('/laptop/hapusFitur/{id}', [LaptopController::class, 'hapusFitur']);
