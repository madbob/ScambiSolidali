<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Media;

class MediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    private function populateMedia($media, $request)
    {
        $media->channel = $request->input('channel', '');
        $media->link = $request->input('link', '');
        $media->text = $request->input('text', '');
        $media->context = $request->input('context', 'media');

        if ($request->has('date')) {
            $media->date = $request->input('date');
        }
        else {
            $media->date = date('Y-m-d');
        }

        if ($request->hasFile('file')) {
            $basefolder = currentInstance();
            $filename = $request->file->getClientOriginalName();
            $request->file->move(sys_get_temp_dir(), $filename);
            $path = sprintf('%s/%s', sys_get_temp_dir(), $filename);
            Storage::disk('media')->put($basefolder . '/' . $filename, file_get_contents($path), 'public');
            $media->link = Storage::disk('media')->url($basefolder . '/' . $filename);
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

        return redirect(url('parlano-di-noi'));
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

        return redirect(url('parlano-di-noi'));
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

        return redirect(url('parlano-di-noi'));
    }
}
