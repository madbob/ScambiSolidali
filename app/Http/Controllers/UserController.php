<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use Mail;

use App\Mail\NewUserCreated;
use App\User;
use App\Institute;
use App\Receiver;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $institutes = Institute::orderBy('name', 'asc')->get();

        if ($user && $user->role == 'admin') {
            $users = User::orderBy('surname', 'asc')->get();
            $admins_count = User::where('role', 'admin')->count();
            $users_count = User::where('role', 'user')->count();
            $operators_count = User::where('role', 'operator')->count();
            $carriers_count = User::where('role', 'carrier')->count();
        }
        else {
            $users = [];
            $admins_count = 0;
            $users_count = 0;
            $operators_count = 0;
            $carriers_count = 0;
        }

        return view('pages.players', [
            'user' => $user,
            'institutes' => $institutes,
            'users' => $users,
            'admins_count' => $admins_count,
            'users_count' => $users_count,
            'operators_count' => $operators_count,
            'carriers_count' => $carriers_count,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->role = $request->input('role');

        $password = str_random(10);
        $user->password = bcrypt($password);

        $user->save();

        Mail::to($user)->send(new NewUserCreated($user, $password));

        Session::flash('message', 'Nuovo utente salvato. Gli è stata inviata una mail con la password');
        return redirect(url('utente'));
    }

    public function show($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $user = User::find($id);
        return view('user.modal', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255'
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->role = $request->input('role');

        $password = $request->input('password');
        if ($password != '')
            $user->password = bcrypt($password);

        $user->save();

        $user->institutes()->sync($request->input('institutes', []));

        Session::flash('message', 'Utente salvato');
        return redirect(url('giocatori'));
    }

    public function destroy($id)
    {
        //
    }
}
