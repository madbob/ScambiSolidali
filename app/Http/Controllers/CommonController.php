<?php

namespace App\Http\Controllers;

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

    public function players()
    {
        return view('pages.players');
    }

    public function numbers()
    {
        return view('pages.numbers');
    }

    public function media()
    {
        return view('pages.media');
    }

    public function contacts()
    {
        return view('pages.contacts');
    }
}
