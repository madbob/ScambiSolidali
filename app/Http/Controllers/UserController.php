<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Auth;
use Session;
use Mail;
use Log;

use App\Mail\NewUserCreated;
use App\Mail\RoleUpdated;
use App\User;
use App\Institute;
use App\Company;
use App\Receiver;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $institutes = Institute::orderBy('name', 'asc')->get();
        $companies = Company::orderBy('name', 'asc')->get();

        if ($user && $user->role == 'admin') {
            $users = User::orderBy('surname', 'asc')->get();

            foreach(User::existingRoles() as $identifier => $metadata) {
                $count = User::where('role', $identifier)->count();
                $counters[$identifier] = sprintf('%d %s', $count, $metadata->multiple);
            }
        }
        else {
            $users = [];

            foreach(User::existingRoles() as $identifier => $metadata) {
                $counters[$identifier] = sprintf('0 %s', $metadata->multiple);
            }
        }

        $current_tab = 'entities';
        $current_show = -1;
        if ($request->has('show')) {
            $show = $request->input('show');
            $showing = User::find($show);
            if ($showing != null && $showing->status != 'archived') {
                $current_tab = 'users';
                $current_show = $show;
            }
        }

        return view('pages.players', [
            'institutes' => $institutes,
            'companies' => $companies,
            'users' => $users,
            'counters' => $counters,
            'current_show' => $current_show,
            'current_tab' => $current_tab,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|unique:users|max:255'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->birthdate = $request->input('birthdate', null);
        $user->role = $request->input('role');

        $password = Str::random(10);
        $user->password = bcrypt($password);

        $user->save();

        Mail::to($user)->send(new NewUserCreated($user, $password));

        Session::flash('message', 'Nuovo utente salvato. Gli è stata inviata una mail con la password');
        return redirect(url('giocatori'));
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
            'email' => 'required|max:255',
        ]);

        $test = User::where('email', $request->input('email'))->where('id', '!=', $id)->first();
        if ($test) {
            Session::flash('message', 'Un utente con questo indirizzo email esiste già');
            return redirect(url('giocatori'));
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->birthdate = $request->input('birthdate', null);

        $ex_role = $user->role;
        $user->role = $request->input('role');

        $password = $request->input('password');
        if ($password != '') {
            $this->validate($request, [
                'password' => 'min:8',
            ]);

            $user->password = bcrypt($password);
        }

        $user->save();

        $user->institutes()->sync($request->input('institutes', []));
        $user->companies()->sync($request->input('companies', []));

        if ($ex_role == 'user') {
            try {
                Mail::to($user->email)->send(new RoleUpdated($user));
            }
            catch(\Exception $e) {
                Log::error('Impossibile inviare notifica cambiamento ruolo utente ' . $user->id . ': ' . $e->getMessage());
            }
        }

        Session::flash('message', 'Utente salvato');
        return redirect(url('giocatori'));
    }

    public function reverify(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $user = User::find($id);
        $user->sendActivationNotification();
        Session::flash('message', 'Email di verifica mandata');
        return redirect(url('giocatori'));
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $user = User::find($id);
        $user->donations()->delete();
        $user->delete();

        Session::flash('message', 'Utente eliminato');
        return redirect(url('giocatori'));
    }

    public function massiveMail(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $recipients = $request->input('recipients');
        $subject = $request->input('subject');
        $body = $request->input('body');

        $users = User::where('role', $recipients)->get();
        $count = 0;

        foreach($users as $user) {
            try {
                Mail::send('mails.generic', ['text' => $body], function($message) use ($user, $subject){
                    $message->to($user->email);
                    $message->subject(env('APP_NAME') . ': ' . $subject);
                });

                $count++;
                usleep(100000);
            }
            catch(\Exception $e) {
                Log::error('Impossibile inviare mail a ' . $user->email . ': ' . $e->getMessage());
            }
        }

        Session::flash('message', sprintf('Mail inviata a %d destinatari', $count));
        return redirect(url('giocatori'));
    }

    public function export()
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        header("Content-type: text/csv");
        header('Content-Disposition: attachment; filename="utenti_celocelo.csv";');

        echo sprintf('"NOME";"COGNOME";"TELEFONO";"EMAIL";"TIPO"' . "\n");
        $users = User::orderBy('surname', 'asc')->get();
        foreach($users as $user) {
            $row = [];
            $row[] = $user->name;
            $row[] = $user->surname;
            $row[] = $user->phone;
            $row[] = $user->email;
            $row[] = $user->role;
            echo sprintf("%s\n", join(';', $row));
        }
    }

    public function bypass($id)
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            Auth::loginUsingId($id);
        }

        return redirect(url('/'));
    }
}
