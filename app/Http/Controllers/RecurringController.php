<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Log;
use DB;

use App\Recurring;
use App\RecurringPick;
use App\Institute;

class RecurringController extends Controller
{
    public function index()
    {
        if (env('HAS_FOOD', false) == false) {
            return redirect(url('/'));
        }

        $user = Auth::user();
        if (empty($user) || $user->role != 'admin') {
            return redirect(url('/'));
        }

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
        if (env('HAS_FOOD', false) == false) {
            return redirect(url('/'));
        }

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
        if (env('HAS_FOOD', false) == false) {
            return redirect(url('/'));
        }

        $token = $request->input('token');
        if (is_null($token)) {
            return redirect(url('/'));
        }

        $call = Recurring::where('identifier', $token)->first();
        if (is_null($call)) {
            return redirect(url('/'));
        }

        $call->filled = true;

        $type = $request->input('recurring_type');
        $having = $request->input('having');

        $contents = (object) [
            'having' => $having,
            'notes' => strip_tags($request->input('notes')),
        ];

        if ($having) {
            if ($type == 'weekly') {
                $contents->quantity = $request->input('boxes');
                $contents->comment = $request->input('comment');
            }
            else if ($type == 'monthly') {
                $contents->quantities = [];
                $types = $request->input('type');
                $quantities = $request->input('quantity');

                foreach($types as $index => $t) {
                    $q = $quantities[$index];
                    if (!empty($q)) {
                        $contents->quantities[] = (object) [
                            'type' => $t,
                            'quantity' => $q
                        ];
                    }
                }
            }
        }
        else {
            if ($type == 'weekly') {
                $contents->quantity = 0;
            }
            else if ($type == 'monthly') {
                $contents->quantities = [];
            }
        }

        $call->contents = json_encode($contents);
        $call->save();

        return view('recurring.thanks', ['call' => $call]);
    }

    private function testUserInstitute()
    {
        $valid = false;

        $user = Auth::user();
        if (empty($user)) {
            return redirect(url('/'));
        }

        foreach($user->institutes as $institute) {
            if ($institute->food == true) {
                $valid = true;
                break;
            }
        }

        return $valid;
    }

    public function booking()
    {
        if (env('HAS_FOOD', false) == false) {
            return redirect(url('/'));
        }

        $valid = self::testUserInstitute();
        if ($valid == false) {
            return redirect(url('/'));
        }

        $data = Recurring::buildMonthlyData();
        return view('recurring.booking', ['data' => $data]);
    }

    public function saveBooking(Request $request)
    {
        if (env('HAS_FOOD', false) == false) {
            return redirect(url('/'));
        }

        $valid = self::testUserInstitute();
        if ($valid == false) {
            return redirect(url('/'));
        }

        $institute_id = $request->input('institute_id');
        $institute = Institute::find($institute_id);

        $pick = $institute->currentRecurringPick();
        if (is_null($pick)) {
            $pick = new RecurringPick();
            $pick->institute_id = $institute_id;
            $pick->closed = false;
        }

        $contents = (object) [
            'quantities' => [],
        ];

        $types = $request->input('type');
        $quantities = $request->input('quantity');

        foreach($types as $index => $t) {
            $q = $quantities[$index];
            if (!empty($q)) {
                $contents->quantities[] = (object) [
                    'type' => $t,
                    'quantity' => $q
                ];
            }
        }

        $pick->contents = json_encode($contents);
        $pick->save();
        return redirect()->route('periodico.prenota');
    }

    public function resetWeekly(Request $request)
    {
        if (env('HAS_FOOD', false) == false || $request->user()->role != 'admin') {
            return redirect(url('/'));
        }

        Recurring::generateWeekly();
        return redirect()->route('periodico.index');
    }

    public function resetMonthly(Request $request)
    {
        if (env('HAS_FOOD', false) == false || $request->user() == null || $request->user()->role != 'admin') {
            return redirect(url('/'));
        }

        Recurring::generateMonthly();
        return redirect()->route('periodico.index');
    }

    public function archive(Request $request)
    {
        if (env('HAS_FOOD', false) == false || $request->user() == null || $request->user()->role != 'admin') {
            return redirect(url('/'));
        }

        $dates = Recurring::weekly()->select(DB::raw('DATE(created_at) as created_at'))->distinct()->orderBy('created_at', 'desc')->get();

        if ($request->has('date')) {
            $date = $request->input('date');
        }
        else {
            if ($dates->isEmpty() == false)
                $date = $dates->first()->created_at;
            else
                $date = null;
        }

        $recurrings = Recurring::weekly()->where(DB::raw('DATE(created_at)'), $date)->get();

        return view('recurring.archive', [
            'dates' => $dates,
            'weekly' => $recurrings
        ]);
    }
}
