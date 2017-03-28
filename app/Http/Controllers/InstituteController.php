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
            'code' => 'required|max:255',
            'address' => 'required|max:255',
            'coordinates' => 'required|max:255',
        ]);

        $institute = new Institute();
        $institute->name = $request->input('name');
        $institute->code = $request->input('code');
        $institute->address = $request->input('address');
        $coordinates = explode(',', $request->input('coordinates'));
        $institute->lat = $coordinates[0];
        $institute->lng = $coordinates[1];
        $institute->save();

        Session::flash('message', 'Nuovo ente salvato. Gli operatori devono registrarsi usando il codice ' . $institute->code);
        return redirect(url('giocatori'));
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
            'address' => 'required|max:255',
            'coordinates' => 'required|max:255',
        ]);

        $institute = Institute::find($id);
        $institute->name = $request->input('name');
        $institute->address = $request->input('address');
        $coordinates = explode(',', $request->input('coordinates'));
        $institute->lat = $coordinates[0];
        $institute->lng = $coordinates[1];
        $institute->save();

        Session::flash('message', 'Ente salvato');
        return redirect(url('giocatori'));
    }

    public function destroy($id)
    {
        //
    }
}
