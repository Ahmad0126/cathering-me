<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Pesanan as ModelsPesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pesanan extends Controller
{
    public function index(){
        if(Auth::user()->role === 'Merchant'){
            $data['pesanan'] = ModelsPesanan::get_pesanan_merchant(Auth::id());
        }else{
            $data['pesanan'] = ModelsPesanan::get_pesanan_customer(Auth::id());
        }
        return view('pesanan', $data);
    }
    public function pesan($id){
        $data['menu'] = Menu::find($id);
        return view('customer.pesan', $data);
    }
    public function invoice($id){
        $data['pesanan'] = ModelsPesanan::get_detail_pesanan($id);
        $menu = Menu::find($data['pesanan']->id_menu);
        $data['user'] = User::find($menu->id_user);
        return view('invoice', $data);
    }
    public function store(Request $request){
        $request->validate([
            'id_menu' => 'required|integer',
            'jumlah' => 'required|integer',
            'lokasi' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        try {
            $pesanan = new ModelsPesanan();
            $pesanan->id_user = Auth::id();
            $pesanan->id_menu = $request->id_menu;
            $pesanan->jumlah = $request->jumlah;
            $pesanan->lokasi = $request->lokasi;
            $pesanan->tanggal = $request->tanggal;
            $pesanan->status = 'Diminta';
            $pesanan->save();
        } catch (\Throwable $th) {
            return redirect(route('pesanan'))->withErrors('Pemesanan gagal: '.$th->getMessage());
        }

        return redirect(route('pesanan'))->with('alert', 'Pemesanan berhasil');
    }
    public function hapus($id){
        ModelsPesanan::destroy($id);
        return redirect(route('pesanan'))->with('alert', 'Pembatalan berhasil');
    }
}
