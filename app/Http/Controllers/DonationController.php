<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Mail;

use App\Mail\CallReponsed;
use App\Donation;
use App\Receiver;
use App\Call;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['edit', 'update']]);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $data['donations'] = Donation::whereIn('status', ['pending'])->orderBy('created_at', 'desc')->paginate(50);

        if ($request->has('show'))
            $data['current_show'] = $request->input('show');
        else
            $data['current_show'] = -1;

        return view('donation.list', $data);
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        if($request->has('call'))
            $call = Call::find($request->input('call'));
        else
            $call = null;

        return view('donation.create', ['user' => $user, 'call' => $call]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'description' => 'required',
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'photo' => 'required|file',
        ]);

        $donation = new Donation();
        $donation->user_id = Auth::user()->id;
        $donation->title = $request->input('title');
        $donation->category_id = $request->input('category_id');
        $donation->description = $request->input('description');
        $donation->name = $request->input('name');
        $donation->surname = $request->input('surname');
        $donation->address = $request->input('address');
        $donation->call_id = $request->input('call_id', null);
        $donation->phone = $request->input('phone');
        $donation->email = $request->input('email');
        $donation->shipping_notes = $request->input('shipping_notes');
        $donation->status = 'pending';
        $donation->recoverable = $request->has('recoverable');
        $donation->save();

        if ($request->hasFile('photo')) {
            $request->file('photo')->move(Donation::photosPath(), $donation->id . '_1');
        }

        if ($request->hasFile('opt_photo')) {
            $opt_photos = $request->file('opt_photo');
            $index = 2;

            foreach ($opt_photos as $op) {
                $op->move(Donation::photosPath(), $donation->id . '_' . $index);
                $index++;
            }
        }

        if ($donation->call_id != null) {
            $call = Call::find($donation->call_id);
            Mail::to($call->user->email)->send(new CallReponsed($donation));
        }

        return view('donation.thanks');
    }

    public function show($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $donation = Donation::find($id);
        return view('donation.modal', ['donation' => $donation]);
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'reason' => 'required',
        ]);

        $donation = Donation::find($id);
        if ($donation != null) {
            $donation->status = 'voided';
            $donation->rating = Donation::declineReasons()[$request->input('reason')]->penalty;
            $donation->save();
            Session::flash('message', 'Donazione archiviata');
        }

        return redirect(url('donazione'));
    }

    public function getImage(Request $request, $id, $index)
    {
        return response()->download(Donation::photosPath() . '/' . $id . '_' . $index);
    }

    public function postBook(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'holder' => 'required|integer|exists:receivers,id'
        ]);

        $donation = Donation::find($id);
        if ($donation != null) {
            $receiver = Receiver::find($request->input('holder'));
            $donation->receivers()->attach($receiver, [
                'operator_id' => Auth::user()->id,
                'status' => 'booked',
                'notes' => $request->input('notes'),
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s')
            ]);

            Session::flash('message', 'Donazione etichettata');
        }

        return redirect(url('donazione'));
    }

    public function postAssign(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'holder' => 'required|integer|exists:receivers,id'
        ]);

        $donation = Donation::find($id);
        if ($donation != null) {
            $receiver = Receiver::find($request->input('holder'));
            $donation->receivers()->attach($receiver, [
                'operator_id' => Auth::user()->id,
                'status' => $request->has('shipping') ? 'shipping_needed' : 'assigned',
                'notes' => $request->input('notes'),
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s')
            ]);

            $donation->status = 'assigned';
            $donation->rating = 5;
            $donation->save();

            Session::flash('message', 'Donazione assegnata. È stata inviata una mail al donatore per avere informazioni sul ritiro, trovi i dettagli nella pagina "Archivio"');
        }

        return redirect(url('donazione'));
    }
}
