<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;

use App\Call;
use App\Category;

class CallController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $edit_enabled = ($user != null && ($user->role == 'admin' || $user->role == 'operator'));

        $query = Call::orderBy('updated_at', 'desc');

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

        if ($edit_enabled == false)
            $query->whereIn('status', ['open', 'closed']);

        $calls = $query->paginate(50);

        return view('call.list', ['calls' => $calls, 'edit_enabled' => $edit_enabled, 'filter' => $filter]);
    }

    private function requestInCall($call, $request)
    {
        $category = $request->input('category_id');
        if ($category == 'service') {
            $call->type = 'service';
            $call->category_id = -1;
        }
        else {
            $call->type = 'object';
            $call->category_id = $category;
        }

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
        if ($user == null || ($user->role != 'admin' && $user->role != 'operator'))
            return view('call.info', ['call' => $call]);
        else
            return view('call.modal', ['call' => $call]);
    }

    public function update(Request $request, $id)
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

        $call = Call::find($id);
        $this->requestInCall($call, $request);
        $call->save();

        Session::flash('message', 'Appello salvato');
        return redirect(url('manca'));
    }
}
