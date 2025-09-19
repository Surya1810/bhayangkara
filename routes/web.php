<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\PengumumanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

//Beranda
Route::get('/', [PageController::class, 'beranda'])->name('landing');
Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/berita/{slug}', [PageController::class, 'detail_berita'])->name('detail.berita');
Route::get('/kategori/{slug}', [PageController::class, 'kategori'])->name('kategori');
Route::get('/tentang-kami', [PageController::class, 'tentang'])->name('tentang');
Route::get('/tim-redaksi', [PageController::class, 'redaksi'])->name('redaksi');
Route::get('/lapor', [PageController::class, 'lapor'])->name('lapor');
Route::post('/lapor/store', [PageController::class, 'laporan'])->name('lapor.store');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');

//Backend Auth
Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Profile Section
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password/{id}', [ProfileController::class, 'password'])->name('profile.password');
    Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Video
    Route::resource('video', VideoController::class);

    // Pengumuman
    Route::resource('pengumuman', PengumumanController::class)->only([
        'create',
        'store',
        'destroy'
    ]);

    //Category
    Route::resource('categories', CategoryController::class);

    //Post
    Route::get('/posts/approval', [PostController::class, 'approval'])->name('posts.approval');
    Route::get('/posts/approve/{id}', [PostController::class, 'approve'])->name('posts.approve');
    Route::resource('posts', PostController::class);

    //Anggota
    Route::get('/anggota/approval', [UserController::class, 'approval'])->name('anggota.approval');
    Route::get('/anggota/approve/{id}', [UserController::class, 'approve'])->name('anggota.approve');
    Route::resource('anggota', UserController::class);
});
