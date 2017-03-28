<?php

namespace App\Http\Controllers;

use Auth;

class CommonController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function project()
    {
        return view('pages.project');
    }

    public function numbers()
    {
        return view('pages.numbers');
    }

    public function contacts()
    {
        return view('pages.contacts');
    }
}
