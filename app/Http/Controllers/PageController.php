<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\lapor;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\LaporanMasuk;

class PageController extends Controller
{
    //Beranda
    public function beranda()
    {
        $latest = Post::where('is_approved', true)->latest()->take(3)->get();
        $beritas = Post::where('is_approved', true)->latest()->skip(3)->take(60)->paginate(6);
        $categories = Category::all();

        return view('frontend.beranda.index',  compact('latest', 'beritas', 'categories'));
    }

    public function detail_berita($slug)
    {
        $latest = Post::where('is_approved', true)->latest()->take(3)->get();
        $news = Post::where('slug', $slug)->first();
        $categories = Category::all();

        return view('frontend.beranda.detail',  compact('latest', 'news', 'categories'));
    }

    public function kategori($slug)
    {
        $categories = Category::where('slug', $slug)->first();
        $beritas = Post::where('is_approved', true)->where('category_id', $categories->id)->latest()->skip(3)->take(60)->paginate(6);
        $categories = Category::all();

        return view('frontend.beranda.kategori',  compact('beritas', 'categories'));
    }

    public function tentang()
    {
        $categories = Category::all();

        return view('frontend.tentang.index', compact('categories'));
    }

    public function redaksi()
    {
        $categories = Category::all();

        return view('frontend.redaksi.index', compact('categories'));
    }

    public function lapor()
    {
        $categories = Category::all();

        return view('frontend.lapor.index', compact('categories'));
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
        $categories = Category::all();

        return view('frontend.kontak.index', compact('categories'));
    }
}
