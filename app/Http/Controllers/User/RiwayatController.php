<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $sukses = Transaksi::with('pesanan')
                ->whereHas('pesanan', function ($q) {
                    $q->where('id_user', auth()->user()->id_user)
                    ->where('status', 'pending');
                })
                ->where('status', 'settlement')->get();

        $kirim = Transaksi::with('pesanan')
                ->whereHas('pesanan', function ($q) {
                    $q->where('id_user', auth()->user()->id_user)
                    ->where('status', 'send');
                })
                ->where('status', 'settlement')->get();

        $selesai = Transaksi::with('pesanan')
                ->whereHas('pesanan', function ($q) {
                    $q->where('id_user', auth()->user()->id_user)
                    ->where('status', 'accepted');
                })
                ->where('status', 'settlement')->get();

        $batal = Transaksi::with('pesanan')
                ->whereHas('pesanan', function ($q) {
                    $q->where('id_user', auth()->user()->id_user);
                })
                ->where('status', 'expire')->get();

        return view('user.riwayat', compact('sukses', 'kirim', 'selesai', 'batal'));
    }

    public function nota($id)
    {
        $transaksi = Transaksi::where('uuid', $id)->first();
    
        return view('pesan.nota', compact('transaksi'));
    }

    public function terima($id)
    {
        $transaksi = Transaksi::where('uuid', $id)->first();
        $pesanan = Pesanan::where('id_pesanan', $transaksi->id_pesanan)->first();
        $pesanan->status = 'accepted';
        $pesanan->save();
        return redirect()->route('user.riwayat');
    }
}
