<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function login()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $google_user = Socialite::driver('google')->user();
        $user = User::where('email', $google_user->email)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->intended('/');
        } else {
            // generate user id
            $user    = User::latest()->first();
            if($user){
                $id_user = explode('-', $user->id_user);
                $urutan = (int) $id_user[1];
                $urutan++;
            } else {
                $urutan = 1;
            }
            $id_user = 'USR-' . sprintf("%05s", $urutan);

            $new_user = new User();
            $new_user->id = $id_user;
            $new_user->firstname = $google_user->name;
            $new_user->email = $google_user->email;
            $new_user->password = Str::random(10);
            $new_user->save();

            Auth::login($new_user);
            return redirect()->route('home');
        }
        try {
        } catch (Exception $e) {
            // dd($e->getMessage());
            return redirect()->back();
        }
    }
}
