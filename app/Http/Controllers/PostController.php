<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::latest()->get();

        return view('frontend.admin.berita.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        return view('frontend.admin.berita.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categories' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        if (isset($image)) {
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            $image = Image::read($request->file('image'));

            // Main Image Upload on Folder Code
            $imageName = uniqid() . time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = 'post/' . $imageName;
            // Simpan gambar ke disk 'public'
            Storage::disk('public')->put($destinationPath, (string) $image->toWebp(90));
        } else {
            $imageName = "default.png";
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->image = $imageName;
        $post->body = $request->body;
        $post->category_id = $request->categories;
        if (auth()->user()->role == 'Anggota') {
            $post->is_approved = false;
        }
        $post->is_approved = true;
        $post->save();

        return redirect()->route('posts.index')->with(['pesan' => 'Berita Berhasil Dibuat, Menunggu Approval', 'level-alert' => 'alert-success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('frontend.admin.berita.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'      => 'required',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'categories' => 'required',
            'body'       => 'required',
        ]);

        $post = Post::findOrFail($id);

        $image = $request->file('image');
        if (isset($image)) {
            if (!Storage::disk('public')->exists('post')) {
                Storage::disk('public')->makeDirectory('post');
            }

            // Hapus gambar lama jika ada
            if ($post->image && $post->image !== 'default.png' && Storage::disk('public')->exists('post/' . $post->image)) {
                Storage::disk('public')->delete('post/' . $post->image);
            }

            // Baca dan simpan gambar baru
            $image = Image::read($request->file('image'));
            $imageName = uniqid() . time() . '-' . $request->file('image')->getClientOriginalName();
            $destinationPath = 'post/' . $imageName;
            Storage::disk('public')->put($destinationPath, (string) $image->toWebp(90));
        } else {
            $imageName = $post->image; // gunakan gambar lama jika tidak ada upload baru
        }

        // Update post
        $post->user_id     = Auth::id();
        $post->title       = $request->title;
        $post->slug        = Str::slug($request->title);
        $post->image       = $imageName;
        $post->body        = $request->body;
        $post->category_id = $request->categories;
        $post->is_approved = false;
        $post->save();

        return redirect()->route('posts.index')->with([
            'pesan' => 'Post Berhasil Diperbarui',
            'level-alert' => 'alert-success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findorfail($id);
        if ($post->image && Storage::disk('public')->exists('post/' . $post->image)) {
            Storage::disk('public')->delete('post/' . $post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with(['pesan' => 'Berita Berhasil Dihapus', 'level-alert' => 'alert-danger']);
    }

    public function approval()
    {
        $posts = Post::where('is_approved', false)->get();

        return view('backend.post.approval', compact('posts'));
    }

    public function approve($id)
    {
        $post = Post::findorfail($id);
        $post->is_approved = true;
        $post->update();

        return redirect()->route('posts.index')->with(['pesan' => 'Berita Terbit', 'level-alert' => 'alert-success']);
    }
}
