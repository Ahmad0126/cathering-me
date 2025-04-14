<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    public static function get_pesanan_customer($id){
        return DB::table('pesanan')
            ->selectRaw('menu.nama as menu, users.perusahaan, users.name as katering, pesanan.tanggal, pesanan.status, pesanan.id')
            ->join('users', 'users.id', '=', 'pesanan.id_user')
            ->join('menu', 'menu.id', '=', 'pesanan.id_menu')
            ->where('pesanan.id_user', $id)->get();
    }
    public static function get_detail_pesanan($id){
        return DB::table('pesanan')
            ->selectRaw('menu.nama as menu, menu.harga, pesanan.tanggal, pesanan.*, users.name as pemesan, users.perusahaan')
            ->join('menu', 'menu.id', '=', 'pesanan.id_menu')
            ->join('users', 'users.id', '=', 'pesanan.id_user')
            ->where('pesanan.id', $id)->first();
    }
    public static function get_pesanan_merchant($id){
        $menu = DB::table('menu')->where('id_user', $id)->get();

        $data = [];
        foreach ($menu as $m) {
            $pesanan = DB::table('pesanan')->where('id_menu', $m->id)->get();
            if($pesanan->isNotEmpty()){
                $data = array_merge($data, DB::table('pesanan')
                    ->selectRaw('menu.nama as menu, users.perusahaan, users.name as katering, pesanan.tanggal, pesanan.status, pesanan.id')
                    ->join('users', 'users.id', '=', 'pesanan.id_user')
                    ->join('menu', 'menu.id', '=', 'pesanan.id_menu')
                    ->where('pesanan.id_menu', $m->id)->get()->toArray()
                );
            }
        }
            
        return $data;
    }
}
