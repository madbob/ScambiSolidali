<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Session;

class Captcha implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $check = Session::get('captcha_response');
        Session::forget('captcha_response');
        return $value == $check;
    }

    public function message()
    {
        return 'Codice di controllo non valido.';
    }
}
