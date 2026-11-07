<?php

namespace App\Http\Controllers;

use App\Models\Branch;

class BranchMapController extends Controller
{
    public function index()
{
    $branches = Branch::select(
        'id', 'nama', 'alamat', 'telepon', 'jenis', 'latitude', 'longitude'
    )->get();

    return view('peta', compact('branches'));
}
}