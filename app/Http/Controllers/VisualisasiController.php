<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisualisasiController extends Controller
{
    public function index()
    {
        return view('visualisasi.index');
    }
}