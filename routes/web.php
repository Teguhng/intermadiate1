<?php

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchMapController;

Route::get('/profile', function () {
    return view('welcome');
});

Route::get('/profile/{nama}', function ($nama) {
    return 'Hallo, ' . $nama;
});

Route::get('/peta', [BranchMapController::class, 'index']);

Route::get('/branches/create', function () {
    return view('create'); // Sesuaikan karena file Anda bernama create.blade.php di luar subfolder
})->name('branches.create');

// Route untuk menyimpan data dari form ke database
Route::post('/branches', function (Request $request) {
    Branch::create([
        'nama' => $request->nama,
        'jenis' => $request->jenis,
        'alamat' => $request->alamat,
        'telepon' => $request->telepon,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
    ]);

    return redirect('/peta');
})->name('branches.store');

Route::get('/branches', function () {
    $branches = Branch::all();
    return view('branches', compact('branches')); 
})->name('branches.index');