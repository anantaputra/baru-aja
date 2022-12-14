<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $terbaru = Produk::latest()->take(4)->get();
        return view('home', compact('terbaru'));
    }

    public function product()
    {
        return view('product');
    }

    public function contact()
    {
        return view('contact');
    }

    public function detail($id)
    {
        $produk = Produk::where('uuid', $id)->first();
        return view('detail', compact('produk'));
    }
}
