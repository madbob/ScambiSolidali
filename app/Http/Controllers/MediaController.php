<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Media;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    private function redirectByContext($context)
    {
        if ($context == 'media') {
            return redirect(url('parlano-di-noi'));
        }
        else {
            return redirect()->route('media.gallery', $context);
        }
    }

    private function populateMedia($media, $request)
    {
        $media->channel = $request->input('channel', '');
        $media->link = $request->input('link', '');
        $media->text = $request->input('text', '');
        $media->context = $request->input('context', 'media');

        if ($request->has('date')) {
            $media->date = decodeDate($request->input('date'));
        }
        else {
            $media->date = date('Y-m-d');
        }

        if ($request->hasFile('file')) {
            $filename = $request->file->getClientOriginalName();
            $request->file->move(public_path() . '/media/', $filename);
            $media->link = url('/media/' . $filename);
        }

        return $media;
    }

    public function index()
    {
        $user = Auth::user();
        $media = Media::where('context', 'media')->orderBy('date', 'desc')->get();
        $edit_enabled = ($user && $user->role == 'admin');
        return view('media.list', ['media' => $media, 'edit_enabled' => $edit_enabled]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $media = new Media();
        $media = self::populateMedia($media, $request);
        $media->save();

        return self::redirectByContext($media->context);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $media = Media::find($id);
        $media = self::populateMedia($media, $request);
        $media->save();

        return self::redirectByContext($media->context);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if ($user->role != 'admin') {
            return redirect(url('/'));
        }

        $media = Media::find($id);
        $context = $media->context;
        $media->delete();

        return self::redirectByContext($context);
    }

    public function gallery(Request $request, $context)
    {
        $user = Auth::user();
        $media = Media::where('context', $context)->orderBy('date', 'desc')->get();
        $edit_enabled = ($user && $user->role == 'admin');
        $layout = 'layouts.' . $context;
        return view('media.gallery', compact('media', 'context', 'edit_enabled', 'layout'));
    }
}
