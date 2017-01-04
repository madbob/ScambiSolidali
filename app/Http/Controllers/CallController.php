<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;

use App\Call;

class CallController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $calls = Call::orderBy('updated_at', 'desc')->paginate(50);
        return view('call.list', ['calls' => $calls]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required',
        ]);

        $call = new Call();
        $call->user_id = $user->id;
        $call->title = $request->input('title');
        $call->body = $request->input('body');
        $call->status = $request->input('status');
        $call->save();

        Session::flash('message', 'Nuovo appello salvato');
        return redirect(url('appello'));
    }

    public function show($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $call = Call::find($id);
        return view('call.modal', ['call' => $call]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
            'status' => 'required',
        ]);

        $call = Call::find($id);
        $call->title = $request->input('title');
        $call->body = $request->input('body');
        $call->status = $request->input('status');
        $call->save();

        Session::flash('message', 'Appello salvato');
        return redirect(url('appello'));
    }
}
