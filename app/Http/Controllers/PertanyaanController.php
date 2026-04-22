<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index()
    {
        return view('pertanyaan.index');
    }
}
