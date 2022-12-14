<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProfilController extends Controller
{
    public function index()
    {
        return view('user.profil');
    }   

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_depan' => 'required',
            'nama_belakang' => 'nullable',
            'phone' => 'max:16',
        ], [
            'required' => ':attribute harus diisi',
            'max' => ':attribute maksimal :max karakter',
        ]);

        DB::beginTransaction();

        try {
            $user = User::find(auth()->user()->id_user);
            if ($user){
                $user->nama_depan = $request->nama_depan;
                $user->nama_belakang = $request->nama_belakang;
                $user->telepon = $request->phone;
                $user->gender = $request->gender;
                $user->save();
                DB::commit();
                return redirect()->route('user.profil');
            }
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function foto(Request $request)
    {
        DB::beginTransaction();

        try {
            $folderPath = public_path('/upload/profil/');
            $image_parts = explode(";base64,", $request->input('foto'));
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.png';
            file_put_contents($file, $image_base64);
            $nama_file = explode('/', $file);
            $count = count($nama_file);
            $filenama = $nama_file[$count - 1];
            $user = User::find(auth()->user()->id_user);
            $user->foto = $filenama;
            $user->save();

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }
}
