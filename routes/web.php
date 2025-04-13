<?php

use App\Http\Controllers\Foto;
use App\Http\Controllers\Home;
use App\Http\Controllers\Menu;
use App\Http\Controllers\User;
use App\Http\Controllers\Kategori;
use App\Http\Controllers\Pesanan;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function(){
    
    Route::get('/register', function () {
        return view('register');
    });
    Route::post('/register', [User::class, 'register']);
    
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [User::class, 'login']);
});

Route::middleware('auth')->group(function(){
    Route::get('/', [Home::class, 'index'])->name('home');
    Route::get('/profil', [User::class, 'profil'])->name('profil');
    Route::post('/profil/update', [User::class, 'update'])->name('user_update');

    Route::middleware('can:merchant')->group(function(){
        Route::get('merchant/menu', [Menu::class, 'index'])->name('menu');
        Route::get('merchant/menu/edit/{id}', [Menu::class, 'edit'])->name('menu_edit');
        Route::get('merchant/menu/hapus/{id}', [Menu::class, 'hapus'])->name('menu_hapus');
        Route::post('merchant/menu/store', [Menu::class, 'store'])->name('menu_store');
        Route::post('merchant/menu/update', [Menu::class, 'update'])->name('menu_update');
        
        Route::post('merchant/foto/upload', [Foto::class, 'upload_foto'])->name('menu_foto');
        Route::get('merchant/foto/hapus/{id?}', [Foto::class, 'hapus_foto'])->name('hapus_foto');
        
        Route::post('merchant/kategori/set', [Kategori::class, 'set_kategori'])->name('set_kategori');
        Route::get('merchant/kategori/hapus/{id}', [Kategori::class, 'hapus_kategori'])->name('hapus_kategori');

        Route::get('pesanan/selesai/{id}', [Pesanan::class, 'selesai'])->name('selesai_pesanan');
        Route::get('pesanan/proses/{id}', [Pesanan::class, 'proses'])->name('proses_pesanan');
    });
    
    Route::middleware('can:customer')->group(function(){
        Route::get('customer/pesan/{id}', [Pesanan::class, 'pesan'])->name('pesan');
        Route::post('customer/pesan', [Pesanan::class, 'store'])->name('pesan_menu');
        Route::get('pesanan/hapus/{id}', [Pesanan::class, 'hapus'])->name('hapus_pesanan');
    });
    
    Route::get('pesanan/', [Pesanan::class, 'index'])->name('pesanan');
    Route::get('pesanan/invoice/{id}', [Pesanan::class, 'invoice'])->name('invoice');
    
    Route::post('logout', [User::class, 'logout'])->name('logout');
});