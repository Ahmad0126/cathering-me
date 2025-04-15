<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;

class Home extends Controller
{
    public function index(){
        $data['title'] = 'KateringME';
        $data['menu'] = Menu::get_all_menu();

        $data['kate'] = [];
        foreach ($data['menu'] as $menu) {
            array_push($data['kate'], Kategori::get_kategori_menu($menu->id));
        }
        
        $data['kategori'] = Kategori::all();
        return view('home', $data);
    }
    public function filter(Request $request){
        $data['title'] = 'Cari Menu '.$request->key;
        $data['menu'] = Menu::filter($request->toArray());

        $data['kate'] = [];
        foreach ($data['menu'] as $menu) {
            array_push($data['kate'], Kategori::get_kategori_menu($menu->id));
        }
        
        $data['kategori'] = Kategori::all();
        return view('home', $data);
    }
}
