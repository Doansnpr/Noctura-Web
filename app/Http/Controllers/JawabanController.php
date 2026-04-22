<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JawabanController extends Controller
{
    public function index()
    {
        return view('jawaban.index');
    }
}
