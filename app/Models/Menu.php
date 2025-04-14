<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    protected $table = 'menu';

    public static function get_all_menu(){
        return DB::table('menu')->select(['menu.id', 'nama', 'harga', 'foto.path'])
            ->join('foto', 'foto.id', '=', DB::raw('(SELECT foto.id FROM foto WHERE menu.id = foto.id_menu LIMIT 1)'), 'left')
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
}
