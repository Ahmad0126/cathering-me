<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menu';

    public static function get_all_menu(){
        return DB::table('menu')->select(['menu.id', 'menu.nama', 'menu.harga', 'foto.path', 'users.name', 'users.perusahaan', 'users.foto', 'users.alamat'])
            ->join('foto', 'foto.id', '=', DB::raw('(SELECT foto.id FROM foto WHERE menu.id = foto.id_menu LIMIT 1)'), 'left')
            ->join('users', 'users.id', '=', 'menu.id_user', 'left')
            ->get();
    }
    public static function get_private_menu($id_user){
        return DB::table('menu')->select(['menu.id', 'nama', 'harga', 'foto.path'])
            ->join('foto', 'foto.id', '=', DB::raw('(SELECT foto.id FROM foto WHERE menu.id = foto.id_menu LIMIT 1)'), 'left')
            ->where('menu.id_user', $id_user)->get();
    }
    public static function get_detail_menu($id){
        return DB::table('menu')->select(['menu.*', 'users.name', 'users.perusahaan', 'users.foto', 'users.alamat'])
            ->join('users', 'users.id', '=', 'menu.id_user', 'left')
            ->where('menu.id', $id)->firstOrFail();
    }
    public static function filter($req){
        $data = DB::table('menu')->select(['menu.id', 'menu.nama', 'menu.harga', 'foto.path', 'users.name', 'users.perusahaan', 'users.foto', 'users.alamat'])
            ->join('foto', 'foto.id', '=', DB::raw('(SELECT foto.id FROM foto WHERE menu.id = foto.id_menu LIMIT 1)'), 'left')
            ->join('users', 'users.id', '=', 'menu.id_user', 'left');

        if(isset($req['key'])){
            $data->where('menu.nama', 'like', "%".$req['key']."%");
        }
        if(isset($req['lokasi'])){
            $data->where('users.alamat', 'like', "%".$req['lokasi']."%");
        }
        if(isset($req['harga'])){
            $data->where('menu.harga', $req['harga_operator'], $req['harga']);
        }
        if(isset($req['kategori'])){
            $menu = DB::table('kategori_relasi')->select('id_menu')->whereIn('id_kategori', $req['kategori'], 'or');
            $data->whereIn('menu.id', $menu);
        }
        
        return $data->get();
    }
}
