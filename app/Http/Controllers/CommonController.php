<?php

namespace App\Http\Controllers;

use Auth;

use App\Donation;
use App\Category;

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

    public function working()
    {
        return view('pages.working');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function numbers()
    {
        $categories = [];
        $parents = Category::with('children')->where('parent_id', 0)->get();
        foreach($parents as $p) {
            $subs = [$p->id];

            foreach($p->children as $c)
                $subs[] = $c->id;

            $count = Donation::where('status', 'assigned')->whereIn('category_id', $subs)->count();
            $categories[$p->name] = $count;
        }

        return view('pages.numbers', ['categories' => $categories]);
    }

    public function contacts()
    {
        return view('pages.contacts');
    }
}
