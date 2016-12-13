<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use Mail;

use App\Mail\NewUserCreated;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $users = User::orderBy('created_at', 'desc')->paginate(50);

        return view('user.list', ['users' => $users]);
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

    public function edit($id)
    {
        //
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

        Session::flash('message', 'Utente salvato');
        return redirect(url('utente'));
    }

    public function destroy($id)
    {
        //
    }
}
