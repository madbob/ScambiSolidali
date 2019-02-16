<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Recurring;

class RecurringController extends Controller
{
    public function index()
    {
        $weekly = Recurring::weekly()->where('closed', false)->with('company')->get();
        $monthly = Recurring::monthly()->where('closed', false)->with('company')->get();

        return view('recurring.list', [
            'weekly' => $weekly,
            'monthly' => $monthly
        ]);
    }

    /*
        Creazione e salvataggio di un elemento sono deliberatamente non
        vincolate all'autenticazione dell'utente, fa fede il token randomico
    */

    public function create(Request $request)
    {
        $token = $request->input('token');
        if (is_null($token)) {
            return redirect(url('/'));
        }

        $call = Recurring::where('identifier', $token)->first();
        if (is_null($call)) {
            return redirect(url('/'));
        }

        return view('recurring.create', ['call' => $call]);
    }

    public function store(Request $request)
    {
        $token = $request->input('token');
        if (is_null($token)) {
            return redirect(url('/'));
        }

        $call = Recurring::where('identifier', $token)->first();
        if (is_null($call)) {
            return redirect(url('/'));
        }

        $call->filled = true;

        $type = $request->input('type');
        $contents = (object) [
            'having' => $request->input('having'),
            'notes' => $request->input('notes'),
        ];

        if ($type == 'weekly') {
            $contents->quantity = $request->input('boxes');
        }
        else if ($type == 'monthly') {
            $contents->quantities = [];
            $types = $request->input('type');
            $quantities = $request->input('quantity');
            foreach($types as $index => $t) {
                if ($t == 'no')
                    continue;

                $q = $quantities[$index];
                if (!empty($q) && $q != 0) {
                    $contents->quantities[] = (object) [
                        'type' => $t,
                        'quantity' => $q
                    ];
                }
            }
        }

        $call->contents = json_encode($contents);

        $call->save();

        return view('recurring.thanks', ['call' => $call]);
    }

    public function show($id)
    {
        //
    }
}
