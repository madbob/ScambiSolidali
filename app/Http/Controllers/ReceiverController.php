<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;

use App\Receiver;

class ReceiverController extends Controller
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

        $users = Receiver::orderBy('surname', 'asc')->paginate(50);
        return view('receiver.list', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255'
        ]);

        $receiver = new Receiver();
        $receiver->name = $request->input('name');
        $receiver->surname = $request->input('surname');
        $receiver->address = $request->input('address');
        $receiver->phone = $request->input('phone');
        $receiver->email = $request->input('email');
        $receiver->notes = $request->input('notes');
        $receiver->save();

        Session::flash('message', 'Nuovo fruitore salvato');
        return redirect(url('fruitore'));
    }

    public function show($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $receiver = Receiver::find($id);
        return view('receiver.modal', ['receiver' => $receiver]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255'
        ]);

        $receiver = Receiver::find($id);
        $receiver->name = $request->input('name');
        $receiver->surname = $request->input('surname');
        $receiver->address = $request->input('address');
        $receiver->phone = $request->input('phone');
        $receiver->email = $request->input('email');
        $receiver->notes = $request->input('notes');
        $receiver->save();

        Session::flash('message', 'Fruitore salvato');
        return redirect(url('fruitore'));
    }

    public function destroy($id)
    {
        //
    }
}
