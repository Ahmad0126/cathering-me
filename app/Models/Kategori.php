<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    protected $table = 'kategori';

    public static function get_kategori_menu($id_menu){
        return DB::table('kategori_relasi')->select(['kategori', 'kategori_relasi.id'])
            ->join('kategori', 'kategori.id', '=', 'kategori_relasi.id_kategori')
            ->where('id_menu', $id_menu)->get();
    }
}
