<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Media;

class MediaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $media = Media::orderBy('date', 'desc')->get();
        $edit_enabled = ($user && $user->role == 'admin');
        return view('media.list', ['media' => $media, 'edit_enabled' => $edit_enabled]);
    }

    public function store(Request $request)
    {
        $media = new Media();
        $media->channel = $request->input('channel');
        $media->date = decodeDate($request->input('date'));
        $media->link = $request->input('link', '');

        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $request->file->move(public_path() . '/media/', $filename);
            $media->link = url('/media/' . $filename);
        }

        $media->save();

        return redirect(url('parlano-di-noi'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
