<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\KategoriRelasi;
use App\Models\Menu as ModelsMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Menu extends Controller
{
    public function index(){
        $data['title'] = 'Kelola Menu';
        $data['menu'] = ModelsMenu::get_private_menu(Auth::id());
        return view('merchant.menu', $data);
    }
    public function edit($id){
        $data['title'] = 'Edit Menu';
        $data['menu'] = ModelsMenu::find($id);
        $data['foto'] = Foto::where('id_menu', $id)->get();
        $data['kategori'] = Kategori::get_kategori_menu($id);
        return view('merchant.menu_edit', $data);
    }
    public function detail($id){
        $data['title'] = 'Detail Menu';
        $data['menu'] = ModelsMenu::get_detail_menu($id);
        $data['foto'] = Foto::where('id_menu', $id)->get();
        $data['kategori'] = Kategori::get_kategori_menu($id);
        return view('detail', $data);
    }
    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable',
        ]);

        try {
            $menu = new ModelsMenu();
            $menu->id_user = Auth::id();
            $menu->nama = $request->nama;
            $menu->harga = $request->harga;
            $menu->deskripsi = $request->deskripsi;
            $menu->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Tambah menu gagal: '.$th->getMessage());
        }
        
        return redirect()->back()->with('alert', 'Tambah menu berhasil!');
    }
    public function update(Request $request){
        $request->validate([
            'id_menu' => 'required',
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'deskripsi' => 'nullable',
        ]);

        try {
            $menu = ModelsMenu::find($request->id_menu);
            $menu->id_user = Auth::id();
            $menu->nama = $request->nama;
            $menu->harga = $request->harga;
            $menu->deskripsi = $request->deskripsi;
            $menu->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Edit menu gagal: '.$th->getMessage());
        }
        
        return redirect()->back()->with('alert', 'Edit menu berhasil!');
    }
    public function hapus($id){
        try {
            $kategori = KategoriRelasi::where('id_menu', $id)->get();
            $foto = Foto::where('id_menu', $id)->get();

            KategoriRelasi::destroy($kategori);
            foreach ($foto as $f) {
                Storage::delete($f->path);
                Foto::destroy($f->id);
            }

            ModelsMenu::destroy($id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Hapus menu gagal: '.$th->getMessage());
        }
        
        return redirect()->back()->with('alert', 'Hapus menu berhasil!');
    }
}
