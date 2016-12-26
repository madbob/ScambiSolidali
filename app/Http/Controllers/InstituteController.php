<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;

use App\Institute;

class InstituteController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $institute = new Institute();
        $institute->name = $request->input('name');
        $institute->code = str_random(10);
        $institute->save();

        Session::flash('message', 'Nuovo ente salvato. Gli operatori devono registrarsi usando il codice ' . $institute->code);
        return redirect(url('utente'));
    }

    public function show($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $institute = Institute::find($id);
        return view('institute.modal', ['institute' => $institute]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $institute = Institute::find($id);
        $institute->name = $request->input('name');
        $institute->save();

        Session::flash('message', 'Ente salvato');
        return redirect(url('utente'));
    }

    public function destroy($id)
    {
        //
    }
}
