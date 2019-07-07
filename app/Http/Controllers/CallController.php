<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Session;

use App\Call;
use App\Category;

class CallController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $data['edit_enabled'] = ($user != null && ($user->role == 'admin' || $user->role == 'operator'));

        $query = Call::orderByRaw(DB::raw("FIELD(status, 'draft', 'open', 'closed', 'archived')"))->orderBy('updated_at', 'desc');

        $filter = $request->input('filter', null);
        if ($filter != null) {
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
        $data['filter'] = $filter;

        if ($data['edit_enabled'] == false)
            $query->whereIn('status', ['open', 'closed']);

        $data['calls'] = $query->paginate(60);

        $data['current_show'] = -1;
        if ($request->has('show')) {
            $show = $request->input('show');
            $showing = Call::find($show);
            if ($showing != null && $showing->status != 'archived') {
                $data['current_show'] = $show;
                $data['pagetitle'] = $showing->title;
            }
        }

        return view('call.list', $data);
    }

    private function requestInCall($call, $request)
    {
        $category_id = $request->input('category_id');
        $category = Category::find($category_id);
        $call->type = $category->type;
        $call->category_id = $category->id;

        $call->title = $request->input('title');
        $call->who = $request->input('who');
        $call->what = $request->input('what');
        $call->whom = $request->input('whom');
        $call->when = decodeDate($request->input('when'));
        $call->notes = $request->input('notes');
        $call->status = $request->input('status');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin' && $user->role != 'operator') {
            return redirect(url('/'));
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'who' => 'required',
            'what' => 'required',
            'whom' => 'required',
            'status' => 'required',
        ]);

        $call = new Call();
        $call->user_id = $user->id;
        $this->requestInCall($call, $request);
        $call->save();

        Session::flash('message', 'Nuovo appello salvato');
        return redirect(url('manca'));
    }

    public function show($id)
    {
        $call = Call::find($id);

        $user = Auth::user();
        if ($user && ($user->role == 'admin' || ($user->role == 'operator' && $call->user_id == $user->id)))
            return view('call.modal', ['call' => $call]);
        else
            return view('call.info', ['call' => $call]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $call = Call::find($id);

        if ($user && ($user->role == 'admin' || ($user->role == 'operator' && $call->user_id == $user->id))) {
            $this->validate($request, [
                'title' => 'required|max:255',
                'who' => 'required',
                'what' => 'required',
                'whom' => 'required',
                'status' => 'required',
            ]);

            $this->requestInCall($call, $request);
            $call->save();

            Session::flash('message', 'Appello salvato');
            return redirect(url('manca'));
        }
        else {
            return redirect(url('/'));
        }
    }
}
