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
use App\Mail\DonationRevoked;
use App\Mail\DonationTransport;
use App\Mail\DonationRequested;

use App\User;
use App\Donation;
use App\Category;
use App\Receiver;
use App\Call;
use App\Message;

class DonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'getImage']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Donation::orderByRaw(DB::raw("FIELD(status, 'pending', 'assigned')"))->orderBy('created_at', 'desc')->whereIn('status', ['pending', 'assigned']);
        $data['user'] = $user;

        $filter = $request->input('filter', null);
        if (!empty($filter)) {
            $category = Category::find($filter);
            if ($category == null) {
                Log::error('Richiesta categoria non esistente per donazioni: ' . $filter);
                $filter = null;
            }
            else {
                if ($category->parent_id == 0) {
                    $subs = [$category->id];

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

        $areafilter = $request->input('areafilter', null);
        if (!empty($areafilter)) {
            $query->where('area', $areafilter);
        }

        $data['areafilter'] = $areafilter;

        $data['donations'] = $query->paginate(60);

        if ($request->has('show'))
            $data['current_show'] = $request->input('show');
        else
            $data['current_show'] = -1;

        $data['edit_enabled'] = ($user != null && ($user->role == 'admin' || $user->role == 'operator'));

        return view('donation.list', $data);
    }

    public function myIndex(Request $request)
    {
        $user = Auth::user();

        $data['donations'] = Donation::where('user_id', $user->id)->where('status', '!=', 'voided')->orderBy('created_at', 'desc')->get();

        if ($user->role == 'admin' || $user->role == 'operator') {
            $data['calls'] = Call::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

            /*
                Questo può essere migliorato per togliere il nome esplicito
                della tabella pivot
            */
            $data['assigned'] = Donation::whereHas('receivers', function($query) use ($user) {
                $query->where('operator_id', $user->id);
            })->orderBy('updated_at', 'desc')->get();
        }
        else {
            $data['calls'] = [];
            $data['assigned'] = [];
        }

        if ($request->has('show'))
            $data['current_show'] = $request->input('show');
        else
            $data['current_show'] = -1;

        return view('donation.mylist', $data);
    }

    public function create(Request $request, $type)
    {
        if($request->has('call')) {
            $call = Call::find($request->input('call'));
            if ($call && $call->category->direct_response) {
                return redirect()->route('manca.index', ['show' => $call->id]);
            }
        }
        else {
            $call = null;
        }

        if ($type == 'servizio')
            return view('donation.service', ['call' => $call]);
        else
            return view('donation.create', ['call' => $call]);
    }

    public function directResponse(Request $request, $call_id)
    {
        $call = Call::find($call_id);
        if ($call && $call->category->direct_response) {
            $user = $request->user();
            $message = strip_tags($request->input('message'));

            try {
                Mail::to($call->user->email)->send(new CallResponded(null, $call, $user, $message));
                Session::flash('message', 'Il tuo messaggio è stato inviato');
            }
            catch(\Exception $e) {
                Log::error('Impossibile inviare notifica di appello diretto risposto da ' . $user->id . ': ' . $e->getMessage());
                Session::flash('message', 'Si è verificato un errore inviando il tuo messaggio! Ti invitiamo a riprovare!');
            }
        }

        return redirect()->route('manca.index');
    }

    private function requestInDonation($donation, $request)
    {
        $donation->type = $request->input('type');
        $donation->title = strip_tags($request->input('title'));
        $donation->category_id = $request->input('category_id', -1);
        $donation->description = strip_tags($request->input('description'));
        $donation->size = $request->input('size', '');
        $donation->since = $request->input('since', null);
        $donation->name = $request->input('name');
        $donation->surname = $request->input('surname');
        $donation->area = $request->input('area');
        $donation->address = $request->input('address', '');
        $donation->call_id = $request->input('call_id', -1);
        $donation->phone = $request->input('phone');
        $donation->email = $request->input('email');
        $donation->floor = $request->input('floor', -1);
        $donation->elevator = $request->has('elevator');
        $donation->shipping_notes = $request->input('shipping_notes', '');
        $donation->autoship = $request->has('autoship');
    }

    private function savePhotos($request, $donation, $index)
    {
        ini_set('gd.jpeg_ignore_warning', 1);
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

        if ($donation->call_id != -1) {
            $call = Call::find($donation->call_id);
            if ($call) {
                $user = $request->user();

                try {
                    Mail::to($call->user->email)->send(new CallResponded($donation, $call, $user, ''));
                }
                catch(\Exception $e) {
                    Log::error('Impossibile inviare notifica di appello risposto per donazione ' . $donation->id . ': ' . $e->getMessage());
                }
            }
        }

        return view('donation.thanks', ['donation' => $donation]);
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

        $original_call = $donation->call_id;

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

        if ($donation->call_id != -1 && $original_call != $donation->call_id) {
            $call = Call::find($donation->call_id);
            if ($call) {
                try {
                    Mail::to($call->user->email)->send(new CallResponded($donation, $call, $user, ''));
                }
                catch(\Exception $e) {
                    Log::error('Impossibile inviare notifica di appello risposto per donazione ' . $donation->id . ': ' . $e->getMessage());
                }
            }
        }

        return redirect(url('donazione/mie'));
    }

    public function show($id)
    {
        $donation = Donation::find($id);
        $user = Auth::user();

        if ($donation->userCanView($user) == false && $donation->user_id != $user->id) {
            abort(404);
        }

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

    public function postContact(Request $request, $id)
    {
        $donation = Donation::find($id);

        $user = Auth::user();

        if ($donation->userCanView($user) == false) {
            return redirect(url('/'));
        }

        $message = new Message();
        $message->sender_id = $user->id;
        $message->donation_id = $id;
        $message->body = strip_tags($request->input('request'));
        $message->save();

        try {
            Mail::to($donation->email)->send(new DonationRequested($message));
        }
        catch(\Exception $e) {
            Log::error('Impossibile inoltrare mail di richiesta per donazione ' . $id . ': ' . $e->getMessage());
        }

        Session::flash('message', 'La tua richiesta è stata inviata');
        return redirect(url('celo'));
    }

    public function renew(Request $request, $token)
    {
        $token = base64_decode(urldecode($token));
        list($donation_id, $user_id) = explode('-', $token);
        $donation = Donation::find($donation_id);
        if ($donation->user_id != $user_id)
            abort(404);

        $donation->renew();

        Session::flash('message', 'La donazione è stata rinnovata per altri due mesi. Grazie!');
        return redirect(url('celo'));
    }

    public function adminRenew(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $donation = Donation::find($id);
        $donation->renew();
        return redirect(url('celo/archivio'));
    }

    public function getImage(Request $request, $id, $index)
    {
        $path = Donation::photosPath() . '/' . $id . '_' . $index;
        if (file_exists($path))
            return response()->download($path);
    }

    public function getArchive(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $data['search'] = '';
        $data['status'] = '';

        $query = Donation::orderBy('created_at', 'desc');

        $search = $request->input('search');
        if (!empty($search)) {
            $query->where('title', 'like', '%' . $search . '%')->orWhereHas('user', function($query) use ($search) {
                $query->where('email', 'like', '%' . $search . '%')->orWhere('name', 'like', '%' . $search . '%')->orWhere('surname', 'like', '%' . $search . '%');
            });
            $data['search'] = $search;
        }

        $status = $request->input('status');
        if (!empty($status)) {
            $query->where('status', '=', $status);
            $data['status'] = $status;
        }

        $data['donations'] = $query->paginate(50);

        return view('donation.archive', $data);
    }

    private function readReceiverArea($request)
    {
        $area = $request->input('receiver-area', 'other');
        if ($area == 'other') {
            $area = $request->input('receiver-area-other', '');
        }

        return $area;
    }

    public function postAssign(Request $request, $id)
    {
        $user = Auth::user();

        $donation = Donation::find($id);
        if ($donation != null && $donation->status != 'assigned') {
            $done = false;
            $receiver_type = $request->input('assignation_type');
            $receiver = new Receiver();
            $receiver->type = $receiver_type;

            if ($user->role == 'admin' || $user->role == 'operator') {
                if ($receiver_type == 'individual') {
                    $receiver->age = $request->input('receiver-age', 0);
                    if (empty($receiver->age))
                        $receiver->age = null;
                    $receiver->gender = $request->input('receiver-gender');
                    $receiver->status = $request->input('receiver-status');
                    $receiver->children = $request->input('receiver-children');
                    $receiver->country = $request->input('receiver-country');
                    $receiver->area = $this->readReceiverArea($request);

                    $receiver->past = $request->input('receiver-past', 0);
                    if (empty($receiver->past))
                        $receiver->past = 0;

                    $done = true;
                }
                else if ($receiver_type == 'organization') {
                    $receiver->organization = $request->input('receiver-organization');
                    $receiver->receivers = $request->input('receiver-receivers');
                    $receiver->area = $this->readReceiverArea($request);

                    $receiver->past = $request->input('receiver-past', 0);
                    if (empty($receiver->past))
                        $receiver->past = 0;

                    $done = true;
                }
            }
            else if ($user->role == 'student') {
                if ($receiver_type == 'self') {
                    $receiver->age = $request->input('receiver-age', 0);
                    if (empty($receiver->age))
                        $receiver->age = null;
                    $receiver->gender = $request->input('receiver-gender');
                    $receiver->status = $request->input('receiver-status');
                    $receiver->children = $request->input('receiver-children');
                    $receiver->country = $request->input('receiver-country');
                    $receiver->area = $this->readReceiverArea($request);

                    $receiver->past = $request->input('receiver-past', 0);
                    if (empty($receiver->past))
                        $receiver->past = 0;

                    $done = true;
                }
            }

            if ($done == false) {
                return redirect(url('/'));
            }

            $receiver->save();

            $donation->receivers()->attach($receiver, [
                'operator_id' => Auth::user()->id,
                'status' => $request->has('shipping') ? 'shipping_needed' : 'assigned',
                'notes' => $request->input('notes') ?? '',
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
                $message = $request->input('message');

                try {
                    Mail::to($donation->email)->send(new DonationAssigned($donation, $user, $user->institutes->first(), $message));
                }
                catch(\Exception $e) {
                    Log::error('Impossibile inviare notifica assegnazione donazione ' . $donation->id . ': ' . $e->getMessage());
                }

                Session::flash('message', 'Donazione assegnata. È stata inviata una mail al donatore di conferma, contattalo per concordare il ritiro del bene. Grazie!');

                if ($request->has('shipping')) {
                    $carriers = User::where('role', 'admin')->get();
                    foreach($carriers as $carrier) {
                        try {
                            Mail::to($carrier->email)->send(new DonationTransport($donation, $user));
                        }
                        catch(\Exception $e) {
                            Log::error('Impossibile inviare notifica richiesta trasporto per donazione ' . $donation->id . ': ' . $e->getMessage());
                        }
                    }
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
                Log::info('Assegnazione su donazione ' . $donation->id . ' revocata da ' . $user->id);

                $rec = Receiver::find($interaction_id);
                $rec->delete();

                if ($donation->receivers->isEmpty()) {
                    $donation->status = 'pending';
                    $donation->save();

                    try {
                        Mail::to($donation->email)->send(new DonationRevoked($donation));
                    }
                    catch(\Exception $e) {
                        Log::error('Impossibile inviare notifica revoca donazione ' . $donation->id . ': ' . $e->getMessage());
                    }
                }

                break;
        }

        return 'ok';
    }

    public function getMyEdit(Request $request, $id)
    {
        $user = Auth::user();

        $donation = Donation::find($id);
        if ($donation->user_id != $user->id)
            return redirect(url('/'));

        if ($donation->type == 'service')
            return view('donation.service', ['donation' => $donation]);
        else
            return view('donation.create', ['donation' => $donation]);
    }

    public function getReport()
    {
        $user = Auth::user();

        if ($user && $user->role == 'admin') {
            header("Content-type: text/csv");
            header('Content-Disposition: attachment; filename="report_celocelo.csv";');

            echo sprintf('"OGGETTO DONATO";"STATUS";"NOTE";"APPELLO";"TIPO";"NOME";"ETÀ";"SESSO";"LAVORO";"FAMIGLIA";"AREA";"NAZIONALITÀ";"OCCORRENZE";"BENEFICIARI"' . "\n");
            $donations = Donation::orderBy('id', 'desc')->get();
            foreach($donations as $donation) {
                if ($donation->status == 'assigned') {
                    $receivers = $donation->receivers()->wherePivot('status', 'assigned')->get();

                    foreach($receivers as $receiver) {
                        $row = [];
                        $row[] = $donation->title;
                        $row[] = $donation->printableStatus();
                        $row[] = sprintf('"%s"', $receiver->pivot->notes);
                        $row[] = $donation->call ? $donation->call->title : '';

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
                else {
                    $row = [];
                    $row[] = $donation->title;
                    $row[] = $donation->printableStatus();
                    $row[] = '';
                    $row[] = $donation->call ? $donation->call->title : '';
                    echo sprintf("%s\n", join(';', $row));
                }
            }
        }
    }
}
