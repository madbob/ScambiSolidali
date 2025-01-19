<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Donation;
use App\Category;
use App\Story;

class CommonController extends Controller
{
    public function logo()
    {
        $city = currentInstance();
        return response()->download(resource_path('images/logo_' . $city . '.png'));
    }

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
        $city = currentInstance();

        if (View::exists('pages.privacy_' . $city)) {
            return view('pages.privacy_' . $city);
        }
        else {
            return view('pages.privacy');
        }
    }

    public function numbers(Request $request)
    {
        $categories = [];
        $parents = Category::with('children')->where('parent_id', 0)->where('type', 'object')->get();
        foreach($parents as $p) {
            $subs = [$p->id];

            foreach($p->children as $c)
                $subs[] = $c->id;

            $count = Donation::where('status', 'assigned')->whereIn('category_id', $subs)->count();
            $categories[$p->name] = $count;
        }

        $stories = Story::orderBy('created_at', 'desc')->get();

        $user = $request->user();
        $edit_enabled = ($user && $user->role == 'admin');

        return view('pages.numbers', [
            'stories' => $stories,
            'categories' => $categories,
            'edit_enabled' => $edit_enabled
        ]);
    }

    public function contacts()
    {
        return view('pages.contacts');
    }
}
