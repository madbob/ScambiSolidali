<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Mail;
use Log;
use Session;

use App\User;
use App\Institute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
            'privacy' => 'required',
        ]);
    }

    private function finalizeRegister($input, $institute)
    {
        $user = $this->create($input);

        Mail::send('mails.activation', ['user' => $user], function($message) use ($user){
            $message->to($user->email);
            $message->subject(env('APP_NAME') . ': attivazione account');
        });

        if ($institute) {
            $institute->users()->attach($user->id);
        }

        Session::flash('message', 'Ti abbiamo inviato una mail per la conferma della registrazione');
        return redirect()->to('login');
    }

    public function register(Request $request) {
        $input = $request->all();
        $input['role'] = 'user';
        $validator = $this->validator($input);

        if ($validator->passes()){
            return $this->finalizeRegister($input, null);
        }

        return back()->with('errors', $validator->errors());
    }

    public function registerOp(Request $request) {
        return view('auth.registerop');
    }

    public function postRegisterOp(Request $request) {
        $code = trim($request->input('code'));
        $institute = Institute::where('code', $code)->first();
        if ($institute == null) {
            Session::flash('message', 'Il codice indicato non è valido');
            return redirect()->to('register/operator');
        }

        $input = $request->all();
        $input['role'] = 'operator';
        $validator = $this->validator($input);

        if ($validator->passes()){
            return $this->finalizeRegister($input, $institute);
        }

        return back()->with('errors', $validator->errors());
    }

    protected function create(array $data)
    {
        Log::debug('Creo utente: ' . print_r($data, true));

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'verification_code' => str_random(15),
            'role' => $data['role']
        ]);
    }

    public function activate(Request $request, $token)
    {
        $user = User::where('verification_code', $token)->first();
        if ($user == null) {
            Session::flash('message', 'Token non riconosciuto');
            return redirect()->to('login');
        }

        $user->verification_code = '';
        $user->save();

        Session::flash('message', 'Account validato, benvenuto su ' . env('APP_NAME'));
        return redirect()->to('login');
    }
}
