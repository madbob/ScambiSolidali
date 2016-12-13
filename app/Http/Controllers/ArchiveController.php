<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Donation;

class ArchiveController extends Controller
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

        $mine = Donation::whereIn('status', ['assigned'])->whereHas('receivers', function($query) {
            $query->whereIn('status', ['assigned', 'shipping_needed'])->where('operator_id', Auth::user()->id);
        })->orderBy('created_at', 'desc')->get();

        $mine_ids = [];
        foreach($mine as $m)
            $mine_ids[] = $m->id;

        $donations = Donation::whereNotIn('status', ['pending'])->whereNotIn('id', $mine_ids)->orderBy('created_at', 'desc')->paginate(50);
        return view('archive.list', ['mine' => $mine, 'donations' => $donations]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $donation = Donation::find($id);
        $status = $request->input('status');

        $receivers = $donation->receivers;
        $current_receiver = null;
        foreach($receivers as $receiver) {
            if ($receiver->pivot->operator_id == $user->id && ($receiver->pivot->status == 'assigned' || $receiver->pivot->status == 'shipping_needed'))
                $current_receiver = $receiver;
        }

        switch($status) {
            case 'pending':
                $donation->status = 'pending';
                $donation->rating = 0;
                $donation->availability = '[]';
                $donation->save();
                $donation->receivers()->updateExistingPivot($current_receiver->id, ['status' => 'voided']);
                break;

            case 'voided':
                $donation->status = 'voided';
                $donation->rating = Donation::declineReasons()['not-matching']->penalty;
                $donation->save();
                $donation->receivers()->updateExistingPivot($current_receiver->id, ['status' => 'voided']);
                break;

            case 'shipped':
                $donation->receivers()->updateExistingPivot($current_receiver->id, ['status' => 'shipped']);
                break;
        }

        return redirect(url('archivio'));
    }
}
