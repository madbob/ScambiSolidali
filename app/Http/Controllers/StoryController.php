<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Story;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $story = new Story();
        $story->title = $request->input('title');
        $story->contents = $request->input('contents');
        $story->save();

        if ($request->hasFile('file')) {
            $request->file->move(public_path() . '/stories/', $story->id);
        }

        return redirect(url('numeri'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $story = Story::find($id);
        $story->title = $request->input('title');
        $story->contents = $request->input('contents');

        if ($request->hasFile('file')) {
            $request->file->move(public_path() . '/stories/', $story->id);
        }

        $story->save();

        return redirect(url('numeri'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $story = Story::find($id);
        $story->delete();
        return redirect(url('numeri'));
    }
}
