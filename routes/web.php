<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchMapController;

Route::get('/profile', function () {
    return view('welcome');
});

Route::get('/profile/{nama}', function ($nama) {
    return 'Hallo, ' . $nama;
});

Route::get('/peta', [BranchMapController::class, 'index']);