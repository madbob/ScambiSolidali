<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Mail;
use Log;
use diversen\imageRotate;

use App\Mail\CallResponded;
use App\Mail\DonationAssigned;
use App\Mail\DonationTransport;
use App\User;
use App\Donation;
use App\Category;
use App\Receiver;
use App\Call;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'getImage']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Donation::orderByRaw(DB::raw("FIELD(status, 'pending', 'assigned', 'recovered')"))->orderBy('created_at', 'desc');

        if ($user && $user->role == 'carrier')
            $query->where('recoverable', true)->whereIn('status', ['expired', 'recovered']);
        else
            $query->whereIn('status', ['pending', 'assigned']);

        $data['user'] = $user;

        $filter = $request->input('filter', null);
        if ($filter != null) {
            if ($filter == 'service') {
                $query->where('type', 'service');
            }
            else {
                $query->where('type', 'object');

                $category = Category::find($filter);
                if ($category->parent_id == 0) {
                    $subs = [];
                    foreach($category->children as $children)
                        $subs[] = $children->id;

                    $query->whereIn('category_id', $subs);
                }
                else {
                    $query->where('category_id', $category->id);
                }
            }
        }

        $data['filter'] = $filter;
        $data['donations'] = $query->paginate(50);

        if ($request->has('show'))
            $data['current_show'] = $request->input('show');
        else
            $data['current_show'] = -1;

        $data['edit_enabled'] = ($user != null && ($user->role == 'admin' || $user->role == 'operator' || $user->role == 'carrier'));

        return view('donation.list', $data);
    }

    public function myIndex(Request $request)
    {
        $user = Auth::user();

        $data['donations'] = Donation::where('user_id', $user->id)->where('status', '!=', 'voided')->orderBy('created_at', 'desc')->get();

        if ($user->role == 'admin' || $user->role == 'operator')
            $data['calls'] = Call::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        else
            $data['calls'] = [];

        if ($request->has('show'))
            $data['current_show'] = $request->input('show');
        else
            $data['current_show'] = -1;

        return view('donation.mylist', $data);
    }

    public function create(Request $request, $type)
    {
        $user = Auth::user();

        if($request->has('call'))
            $call = Call::find($request->input('call'));
        else
            $call = null;

        if ($type == 'servizio')
            return view('donation.service', ['user' => $user, 'call' => $call]);
        else
            return view('donation.create', ['user' => $user, 'call' => $call]);
    }

    private function requestInDonation($donation, $request)
    {
        $donation->type = $request->input('type');
        $donation->title = $request->input('title');
        $donation->category_id = $request->input('category_id', -1);
        $donation->description = $request->input('description');
        $donation->size = $request->input('size', '');
        $donation->name = $request->input('name');
        $donation->surname = $request->input('surname');
        $donation->address = $request->input('address', '');
        $donation->call_id = $request->input('call_id', null);
        $donation->phone = $request->input('phone');
        $donation->email = $request->input('email');
        $donation->floor = $request->input('floor', -1);
        $donation->elevator = $request->has('elevator');
        $donation->shipping_notes = $request->input('shipping_notes', '');
        $donation->autoship = $request->has('autoship');
        $donation->recoverable = $request->has('recoverable');
    }

    private function savePhotos($request, $donation, $index)
    {
        $rotate = new imageRotate();

        foreach ($request->file('photo') as $op) {
            $op->move(Donation::photosPath(), $donation->id . '_' . $index);
            $path = sprintf('%s/%d_%d', Donation::photosPath(), $donation->id, $index);

            try {
                $rotate->fixOrientation($path);
            }
            catch(\Exception $e) {
                Log::error('Impossibile ruotare immagine in ' . $path . ': ' . $e->getMessage());
            }

            $index++;
        }
    }

    public function store(Request $request)
    {
        $type = $request->input('type');

        if ($type == 'object') {
            $this->validate($request, [
                'title' => 'required|max:255',
                'category_id' => 'required|integer|exists:categories,id',
                'description' => 'required',
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'address' => 'required|max:255',
                'phone' => 'required|max:255',
                'email' => 'required|max:255'
            ]);
        }
        else {
            $this->validate($request, [
                'title' => 'required|max:255',
                'description' => 'required',
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'phone' => 'required|max:255',
                'email' => 'required|max:255'
            ]);
        }

        $donation = new Donation();
        $donation->user_id = Auth::user()->id;
        $this->requestInDonation($donation, $request);
        $donation->status = 'pending';
        $donation->save();

        if (!empty($request->file('photo', null))) {
            $index = 1;
            $this->savePhotos($request, $donation, 1);
        }

        if ($donation->call_id != null) {
            $call = Call::find($donation->call_id);
            Mail::to($call->user->email)->send(new CallResponded($donation, $call));
        }

        return view('donation.thanks');
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::user();
        $donation = Donation::find($id);

        if ($donation->user_id != $user->id)
            return redirect(url('/'));

        if ($donation->status != 'pending')
            return redirect(url('/'));

        return view('donation.editmodal', ['donation' => $donation]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $donation = Donation::find($id);

        if ($donation->user_id != $user->id)
            return redirect(url('/'));

        if ($donation->status != 'pending')
            return redirect(url('/'));

        $this->requestInDonation($donation, $request);
        $donation->save();

        $kept_photos = [];
        $keep = $request->input('keep_photo', []);
        $tot = $donation->imagesNum();

        for($i = 1, $index = 1; $i <= $tot; $i++) {
            $path = sprintf("%s%s", Donation::photosPath(), $donation->id . '_' . $i);

            if (array_search($i, $keep) === false)
                unlink($path);
            else
                $kept_photos[$index++] = $path;
        }

        foreach($kept_photos as $index => $path) {
            $new_path = sprintf("%s%s", Donation::photosPath(), $donation->id . '_' . $index);
            rename($path, $new_path);
        }

        if (!empty($request->file('photo', null))) {
            $index = $donation->imagesNum() + 1;
            $this->savePhotos($request, $donation, $index);
        }

        return redirect(url('donazione/mie'));
    }

    public function show($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator' && $user->role != 'carrier') {
            return redirect(url('/'));
        }

        $donation = Donation::find($id);
        if ($donation->type == 'object')
            return view('donation.modal', ['donation' => $donation]);
        else
            return view('donation.smodal', ['donation' => $donation]);
    }

    public function destroy(Request $request, $id)
    {
        $self_remove = false;
        $donation = Donation::find($id);

        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            if ($donation->user_id != $user->id)
                return redirect(url('/'));
            else
                $self_remove = true;
        }

        $this->validate($request, [
            'reason' => 'required',
        ]);

        if ($donation != null) {
            $donation->status = 'voided';
            $donation->rating = Donation::declineReasons()[$request->input('reason')]->penalty;
            $donation->save();
            Session::flash('message', 'Donazione archiviata');
        }

        if ($self_remove)
            return redirect(url('donazione/mie'));
        else
            return redirect(url('celo'));
    }

    public function renew(Request $request, $token)
    {
        $token = base64_decode(urldecode($token));
        list($donation_id, $user_id) = explode('-', $token);
        $donation = Donation::find($donation_id);
        if ($donation->user_id != $user_id)
            abort(404);

        $donation->status = 'pending';
        $donation->save();

        Session::flash('message', 'La donazione è stata rinnovata per un altro mese. Grazie!');
        return redirect(url('celo'));
    }

    public function getImage(Request $request, $id, $index)
    {
        $path = Donation::photosPath() . '/' . $id . '_' . $index;
        if (file_exists($path))
            return response()->download($path);
    }

    public function getArchive()
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $data['donations'] = Donation::orderBy('created_at', 'desc')->paginate(50);
        return view('donation.archive', $data);
    }

    public function postAssign(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $donation = Donation::find($id);
        if ($donation != null) {
            $receiver_type = $request->input('assignation_type');
            $receiver = new Receiver();
            $receiver->type = $receiver_type;

            if ($receiver_type == 'individual') {
                $receiver->age = $request->input('receiver-age', 0);
                if (empty($receiver->age))
                    $receiver->age = null;
                $receiver->gender = $request->input('receiver-gender');
                $receiver->status = $request->input('receiver-status');
                $receiver->children = $request->input('receiver-children');
                $receiver->country = $request->input('receiver-country');
            }
            else {
                $receiver->organization = $request->input('receiver-organization');
                $receiver->receivers = $request->input('receiver-receivers');
            }

            $receiver->area = $request->input('receiver-area');
            $receiver->past = $request->input('receiver-past', 0);
            if (empty($receiver->past))
                $receiver->past = 0;

            $receiver->save();

            $donation->receivers()->attach($receiver, [
                'operator_id' => Auth::user()->id,
                'status' => $request->has('shipping') ? 'shipping_needed' : 'assigned',
                'notes' => $request->input('notes'),
                'created_at' => date('Y-m-d G:i:s'),
                'updated_at' => date('Y-m-d G:i:s')
            ]);

            $donation->rating = 5;

            /*
                Solo se la donazione riguarda un oggetto essa viene "consumata"
                e ne cambio lo stato, altrimenti (se riguarda un servizio) resta
                a disposizione
            */
            if ($donation->type == 'object') {
                $donation->status = 'assigned';
                Mail::to($donation->email)->send(new DonationAssigned($donation, $user->institutes->first()));
                Session::flash('message', 'Donazione assegnata. È stata inviata una mail al donatore per avere informazioni sul ritiro.');

                if ($request->has('shipping')) {
                    $carriers = User::where('role', 'admin')->get();
                    foreach($carriers as $carrier)
                        Mail::to($carrier->email)->send(new DonationTransport($donation, $user));
                }
            }

            $donation->save();
        }

        return redirect(url('celo'));
    }

    public function postDetach(Request $request, $type, $donation_id, $interaction_id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $donation = Donation::find($donation_id);

        switch($type) {
            case 'assignation':
                $donation->receivers()->detach($interaction_id);

                $rec = Receiver::find($interaction_id);
                $rec->delete();

                if ($donation->receivers->isEmpty()) {
                    $donation->status = 'pending';
                    $donation->save();
                }

                break;
        }

        return 'ok';
    }

    public function postRecovered(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'carrier') {
            return redirect(url('/'));
        }

        $donation = Donation::find($id);
        $donation->timestamps = false;
        $donation->status = ($request->input('status') == 'true') ? 'recovered' : 'expired';
        $donation->save();
        return 'ok';
    }

    public function getMyEdit(Request $request, $id)
    {
        $user = Auth::user();

        $donation = Donation::find($id);
        if ($donation->user_id != $user->id)
            return redirect(url('/'));

        if ($donation->type == 'service')
            return view('donation.service', ['user' => $user, 'donation' => $donation]);
        else
            return view('donation.create', ['user' => $user, 'donation' => $donation]);
    }

    public function getReport()
    {
        $user = Auth::user();

        if ($user && $user->role == 'admin') {
            header("Content-type: text/csv");
            header('Content-Disposition: attachment; filename="report_celocelo.csv";');

            echo sprintf('"OGGETTO DONATO";"NOTE";"APPELLO";"TIPO";"NOME";"ETÀ";"SESSO";"LAVORO";"FIGLI";"AREA";"NAZIONALITÀ";"OCCORRENZE";"BENEFICIARI"' . "\n");
            $donations = Donation::where('status', 'assigned')->get();
            foreach($donations as $donation) {
                $receivers = $donation->receivers()->wherePivot('status', 'assigned')->get();

                foreach($receivers as $receiver) {
                    $row = [];
                    $row[] = $donation->title;
                    $row[] = sprintf('"%s"', $receiver->pivot->notes);

                    $call = $donation->call;
                    if ($call)
                        $row[] = $call->title;
                    else
                        $row[] = '';

                    switch($receiver->type) {
                        case 'individual':
                            $row[] = 'Persona';
                            $row[] = '';
                            $row[] = $receiver->age;
                            $row[] = $receiver->gender;
                            $row[] = $receiver->status;
                            $row[] = $receiver->children;
                            $row[] = $receiver->area;
                            $row[] = $receiver->country;
                            $row[] = $receiver->past;
                            $row[] = 1;
                            break;
                        case 'organization':
                            $row[] = 'Ente';
                            $row[] = $receiver->organization;
                            $row[] = '';
                            $row[] = '';
                            $row[] = '';
                            $row[] = '';
                            $row[] = $receiver->area;
                            $row[] = '';
                            $row[] = $receiver->past;
                            $row[] = $receiver->receivers;
                            break;
                        default:
                            break;
                    }

                    echo sprintf("%s\n", join(';', $row));
                }
            }
        }
    }
}
