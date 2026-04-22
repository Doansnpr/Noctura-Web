<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringPrediksiController extends Controller
{
    public function index()
    {
        return view('monitoring.index');
    }
}