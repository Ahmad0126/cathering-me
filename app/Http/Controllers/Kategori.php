<?php

namespace App\Http\Controllers;

use App\Models\Kategori as ModelsKategori;
use App\Models\KategoriRelasi;
use Illuminate\Http\Request;

class Kategori extends Controller
{
    public function set_kategori(Request $request) {
        $request->validate([
            'kategori' => 'required|string',
            'id_menu' => 'required|integer'
        ]);

        try {
            $kategori = ModelsKategori::where('kategori', $request->kategori)->get();
            if($kategori->isEmpty()){
                $new_kategori = new ModelsKategori();
                $new_kategori->kategori = $request->kategori;
                $new_kategori->save();
                $id_kategori = $new_kategori->id;
            }else{
                $id_kategori = $kategori->first()->id;
            }

            $relasi = new KategoriRelasi();
            $relasi->id_menu = $request->id_menu;
            $relasi->id_kategori = $id_kategori;
            $relasi->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Tambah kategori gagal: '.$th->getMessage());
        }

        return redirect()->back()->with('alert', 'Tambah kategori berhasil');
    }
    public function hapus_kategori($id){
        abort_if($id == null, 404);
        
        try {
            KategoriRelasi::destroy($id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Hapus kategori gagal: '.$th->getMessage());
        }

        return redirect()->back()->with('alert', 'Hapus kategori berhasil');
    }
}
