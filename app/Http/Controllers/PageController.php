<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //Beranda
    public function beranda()
    {
        $latest = Post::where('is_approved', true)->latest()->take(3)->get();
        $beritas = Post::where('is_approved', true)->latest()->skip(3)->take(60)->paginate(6);

        return view('frontend.beranda.index',  compact('latest', 'beritas'));
    }

    public function detail_berita($slug)
    {
        $latest = Post::where('is_approved', true)->latest()->take(3)->get();
        $news = Post::where('slug', $slug)->first();
        $categories = Category::all();

        return view('frontend.beranda.detail',  compact('latest', 'news', 'categories'));
    }

    public function tentang()
    {
        return view('frontend.tentang.index');
    }

    public function kontak()
    {
        return view('frontend.kontak.index');
    }
}
