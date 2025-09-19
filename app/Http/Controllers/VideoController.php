<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.admin.video.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url',
        ]);

        Video::create($request->only(['title', 'youtube_url']));

        return redirect()->route('landing')->with(['pesan' => 'Video berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    public function show(Video $video)
    {
        //
    }

    public function edit(Video $video)
    {
        // 
    }

    public function update(Request $request, Video $video)
    {
        // 
    }

    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->route('landing')->with(['pesan' => 'Video berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
