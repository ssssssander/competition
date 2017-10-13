<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function participate()
    {
        return view('participate');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
}
