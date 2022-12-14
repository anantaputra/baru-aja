<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
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

    public function simpan(Request $request)
    {
        return $request;
        $json = json_decode($request->json);
        $transaksi = new Transaksi();
        $transaksi->id_pesanan = $request->id;
        $transaksi->id_transaksi = $json->order_id;
        $transaksi->metode = $json->payment_type;
        $transaksi->total = $json->gross_amount;
        $transaksi->kode_bayar = $json->pdf_url ?? null;
        $transaksi->status = $json->transaction_status;
        $transaksi->save();

        return redirect()->route('user.tagihan.detail', ['id' => $transaksi->uuid]);
    }
}
