<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Mail;
use Log;
use Session;

use App\User;
use App\Config;
use App\Institute;
use App\Mail\OperatorRequired;
use App\Mail\OperatorInstructions;
use App\Rules\Captcha;

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
            'password' => 'required|min:8|confirmed',
            'privacy' => 'required',
            'check' => ['required', new Captcha()],
        ]);
    }

    private function finalizeRegister($input, $institute)
    {
        $user = $this->create($input);
        $user->sendActivationNotification();

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

        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'verification_code' => Str::random(15),
            'role' => $data['role']
        ]);

        if (isset($data['birthdate'])) {
            $user->birthdate = $data['birthdate'];
            $user->save();
        }

		if (isset($data['area'])) {
            $user->area = $data['area'];
            $user->save();
        }

        if (env('HAS_PUBLIC_OP', false)) {
            if (isset($data['public_op']) && $data['public_op'] == 1) {
                try {
                    Mail::to(env('MAIL_ADMIN'))->send(new OperatorRequired($user));
                }
                catch(\Exception $e) {
                    Log::error('Impossibile notificare richiesta di accesso come operatore: ' . $user->id);
                }
            }
        }

        return $user;
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

		if ($user->role == 'operator') {
			$manual_path = Config::getConf('operator_manual');
			if (filled($manual_path)) {
				try {
					Mail::to($user->email)->send(new OperatorInstructions($user));
				}
				catch(\Exception $e) {
					Log::error('Impossibile inviare email col manuale operatore: ' . $user->id);
				}
			}
		}

        Session::flash('message', 'Account validato, benvenuto su ' . env('APP_NAME'));
        return redirect()->to('login');
    }
}
