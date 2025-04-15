<?php

namespace App\Http\Controllers;

use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Controller
{
    public function profil(){
        $data['title'] = 'Profil Anda';
        $data['user'] = UserModel::find(Auth::id());
        return view('profile', $data);
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|max:60',
            'foto' => 'nullable',
            'perusahaan' => 'nullable|string',
            'alamat' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'telepon' => 'nullable|numeric',
        ]);

        try {
            
            $user = UserModel::find(Auth::id());
            $path = $user->foto;
            if($request->file('foto') != null){
                $path = $request->file('foto')->store('profile');
            }
            $user->name = $request->name;
            $user->perusahaan = $request->perusahaan;
            $user->alamat = $request->alamat;
            $user->deskripsi = $request->deskripsi;
            $user->telepon = $request->telepon;
            $user->foto = $path;
            $user->save();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Update profil gagal: '.$th->getMessage());
        }

        return redirect()->back()->with('alert', 'Update profil berhasil');
    }
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:60',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'role' => 'required|string',
        ]);

        try {
            $user = new UserModel();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
        } catch (\Throwable $th) {
            return redirect(route('login'))->withErrors('Register gagal: '.$th->getMessage());
        }

        return redirect(route('login'))->with('alert', 'Register berhasil, silahkan login');
    }
    public function login(Request $request){
        $cred = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($cred)){
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect(route('login'))->withErrors('Login Gagal')->onlyInput('email');
    }
    public function logout(Request $req){
        Auth::logout();

        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect('/');
    }
}
