<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah digunakan',
            'min' => ':attribute mininal :min karakter',
            'confirmed' => ':attribute tidak cocok'
        ]);

        $user = User::latest()->first();
        if($user){
            $id_user = explode('-', $user->id_user);
            $urutan = (int) $id_user[1];
            $urutan++;
        } else {
            $urutan = 1;
        }
        $id_user = 'USR-' . sprintf("%05s", $urutan);

        $register = new User();
        $register->id_user = $id_user;
        $register->nama_depan = $request->firstname;
        $register->nama_belakang = $request->lastname;
        $register->email = $request->email;
        $register->password = bcrypt($request->password);
        $register->save();

        event(new Registered($user));

        $user = Auth::login($register);

        if($user){
            return redirect()->route('home');
        }

        return redirect()->route('register');
    }
}
