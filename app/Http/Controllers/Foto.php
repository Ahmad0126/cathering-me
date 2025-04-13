<?php

namespace App\Http\Controllers;

use App\Models\Foto as ModelFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Foto extends Controller
{
    public function upload_foto(Request $request) {
        $request->validate([
            'foto' => 'required',
            'id_menu' => 'required|integer'
        ]);

        try {
            foreach($request->file('foto') as $file){
                $path = $file->store('menu');

                $foto = new ModelFoto();
                $foto->path = $path;
                $foto->id_menu = $request->id_menu;
                $foto->save();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Upload foto gagal: '.$th->getMessage());
        }

        return redirect()->back()->with('alert', 'Upload foto berhasil');
    }
    public function hapus_foto($id){
        abort_if($id == null, 404);
        
        try {
            $foto = ModelFoto::find($id);

            Storage::delete($foto->path);
            ModelFoto::destroy($id);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Hapus foto gagal: '.$th->getMessage());
        }

        return redirect()->back()->with('alert', 'Hapus foto berhasil');
    }
}
