<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Home extends Controller
{
    public function index(){
        $data['menu'] = Menu::get_all_menu();
        $data['kategori'] = Kategori::all();
        return view('home', $data);
    }
}
