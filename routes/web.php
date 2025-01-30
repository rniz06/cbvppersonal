<?php

use App\Http\Controllers\PersonalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return redirect('/app');
});

Route::get('personales/ficha/{idpersonal}',[PersonalController::class, 'ficha'])->name('personal.ficha')->middleware('auth');