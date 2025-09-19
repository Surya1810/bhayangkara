<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        return view('frontend.admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'nullable|string|max:255',
            'image'     => 'required|image|mimes:jpg,jpeg,png,gif|max:2048|dimensions:width=200,height=800',
            'position'  => 'required|in:left,right',
        ], [
            'image.dimensions' => 'Ukuran gambar wajib 200x800 px.'
        ]);

        $path = $request->file('image')->store('pengumumans', 'public');

        pengumuman::create([
            'title'    => $request->title,
            'image'    => $path,
            'position' => $request->position,
        ]);

        return redirect()->route('landing')->with(['pesan' => 'Pengumuman berhasil ditambahkan', 'level-alert' => 'alert-success']);
    }

    public function destroy(pengumuman $pengumuman)
    {
        Storage::disk('public')->delete($pengumuman->image);
        $pengumuman->delete();

        return redirect()->route('pengumuman.create')->with(['pesan' => 'Pengumuman berhasil dihapus', 'level-alert' => 'alert-danger']);
    }
}
