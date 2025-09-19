<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\lapor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaporanMasuk;
use App\Models\Video;

class PageController extends Controller
{
    //Beranda
    public function beranda()
    {
        $latest = Post::where('is_approved', true)->latest()->take(3)->get();
        $beritas = Post::where('is_approved', true)->latest()->skip(3)->take(60)->paginate(6);
        $videos = Video::latest()->take(40)->paginate(4);

        return view('frontend.beranda.index',  compact('latest', 'beritas', 'videos'));
    }

    public function detail_berita($slug)
    {
        $latest = Post::where('is_approved', true)->latest()->take(3)->get();
        $news = Post::where('slug', $slug)->first();

        return view('frontend.beranda.detail',  compact('latest', 'news'));
    }

    public function kategori($slug)
    {
        $categories = Category::where('slug', $slug)->first();
        $beritas = Post::where('is_approved', true)->where('category_id', $categories->id)->latest()->skip(3)->take(60)->paginate(6);

        return view('frontend.beranda.kategori',  compact('beritas'));
    }

    public function tentang()
    {

        return view('frontend.tentang.index');
    }

    public function redaksi()
    {

        return view('frontend.redaksi.index');
    }

    public function lapor()
    {

        return view('frontend.lapor.index');
    }

    public function laporan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ktp' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'kronologis' => 'required|string',
            'file' => 'required|image|max:10240', // max 10MB
        ]);

        // Simpan file
        $path = $request->file('file')->store('bukti', 'public');

        // Simpan ke database
        $laporan = lapor::create([
            'name' => $request->name,
            'ktp' => $request->ktp,
            'phone' => $request->phone,
            'kronologis' => $request->kronologis,
            'file_path' => $path,
        ]);

        // Kirim email dengan attachment
        Mail::to('partnernewsbhayangkara@gmail.com')->send(new LaporanMasuk($laporan));

        return redirect()->back()->with([
            'pesan' => 'Laporan berhasil dikirim',
            'level-alert' => 'alert-success'
        ]);
    }


    public function kontak()
    {
        return view('frontend.kontak.index',);
    }
}
