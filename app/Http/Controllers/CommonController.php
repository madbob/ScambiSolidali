<?php

namespace App\Http\Controllers;

class CommonController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }
}
