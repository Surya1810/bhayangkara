<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_berita = Post::where('is_approved', true)->count();
        $total_approval_berita = Post::where('is_approved', false)->count();
        $total_anggota = User::where('role', 'Anggota')->where('is_active', true)->count();
        $total_approval_anggota = User::where('role', 'Anggota')->where('is_active', false)->count();

        return view('backend.dashboard', compact('total_berita', 'total_anggota', 'total_approval_berita', 'total_approval_anggota'));
    }
}
