<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function pesan(Request $request)
    {
        $hash = encrypt($request->uuid."|".$request->qty);

        return redirect()->route('checkout', ['id' => $hash]);
    }

    public function bayar()
    {
        return view('pesan.bayar');
    }
}
