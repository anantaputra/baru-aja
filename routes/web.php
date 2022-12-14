<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\User\ReturController;
use App\Http\Controllers\User\AlamatController;
use App\Http\Controllers\User\ProfilController;
use App\Http\Controllers\User\RiwayatController;
use App\Http\Controllers\Api\RajaOngkirController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Admin\AdminReturController;
use App\Http\Controllers\User\TagihanUserController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminLaporanController;
use App\Http\Controllers\Admin\AdminPesananController;
use App\Http\Controllers\Admin\AdminKategoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('produk', [PageController::class, 'product'])->name('produk');
Route::get('kontak', [PageController::class, 'contact'])->name('kontak');
Route::get('detail/{id}', [PageController::class, 'detail'])->name('detail');

Route::middleware('auth')->group(function(){
    Route::prefix('user')->name('user')->group(function(){
        Route::prefix('profil')->name('.profil')->group(function(){
            Route::get('/', [ProfilController::class, 'index']);
            Route::post('simpan', [ProfilController::class, 'simpan'])->name('.simpan');
            Route::post('foto', [ProfilController::class, 'foto'])->name('.foto');
        });
        Route::prefix('alamat')->name('.alamat')->group(function(){
            Route::get('/', [AlamatController::class, 'index']);
            Route::post('simpan', [AlamatController::class, 'simpan'])->name('.simpan');
            Route::post('edit', [AlamatController::class, 'index'])->name('.edit');
            Route::post('update', [AlamatController::class, 'update'])->name('.update');
            Route::get('{id}/hapus', [AlamatController::class, 'hapus'])->name('.hapus');
            Route::get('{id}/utama', [AlamatController::class, 'utama'])->name('.set.utama');
            Route::get('hapus/edit', [AlamatController::class, 'var_edit'])->name('.var.edit');
            Route::post('ganti', [AlamatController::class, 'ganti_alamat'])->name('.ganti');
            Route::get('provinsi', [RajaOngkirController::class, 'semua_provinsi'])->name('.provinsi');
            Route::get('kota', [RajaOngkirController::class, 'kota'])->name('.kota');
        });
        Route::prefix('password')->name('.password')->group(function(){
            Route::get('/');
        });
        Route::prefix('tagihan')->name('.tagihan')->group(function(){
            Route::get('/', [TagihanUserController::class, 'index']);
            Route::get('{id}', [TagihanUserController::class, 'detail'])->name('.detail');
            Route::get('bayar/{id}', [TagihanUserController::class, 'bayar'])->name('.bayar');
        });
        Route::prefix('riwayat')->name('.riwayat')->group(function(){
            Route::get('/', [RiwayatController::class, 'index']);
            Route::get('{id}', [RiwayatController::class, 'nota'])->name('.nota');
            Route::get('terima/{id}', [RiwayatController::class, 'terima'])->name('.terima');
        });
        Route::prefix('retur')->name('.retur')->group(function(){
            Route::get('/', [ReturController::class, 'index']);
            Route::get('{id}', [ReturController::class, 'tambah'])->name('.tambah');
            Route::post('/', [ReturController::class, 'simpan'])->name('.simpan');
        });
    });
    Route::get('bayar', [PesananController::class, 'bayar'])->name('bayar');
    Route::prefix('keranjang')->name('keranjang')->group(function(){
        Route::get('/', [KeranjangController::class, 'index']);
        Route::post('tambah', [KeranjangController::class, 'tambah'])->name('.tambah');
        Route::get('checkout', [KeranjangController::class, 'checkout'])->name('.checkout');
    });
    Route::prefix('pesan')->name('pesan')->group(function(){
        Route::post('/', [PesananController::class, 'pesan'])->name('.sekarang');
        Route::post('buat', [PesananController::class, 'pesan'])->name('.buat');
    });
    Route::prefix('checkout')->middleware('verified')->name('checkout')->group(function(){
        Route::get('{id}', [CheckoutController::class, 'checkout']);
        Route::get('keranjang', [CheckoutController::class, 'keranjang'])->name('.keranjang');
        Route::post('simpan', [CheckoutController::class, 'simpan'])->name('.simpan');
    });
});

Route::prefix('admin')->name('admin')->middleware('auth')->group(function(){
    Route::get('/', [AdminHomeController::class, 'index']);
    Route::prefix('kategori')->name('.kategori')->group(function(){
        Route::get('/', [AdminKategoriController::class, 'index']);
        Route::get('tambah', [AdminKategoriController::class, 'tambah'])->name('.tambah');
        Route::post('tambah', [AdminKategoriController::class, 'simpan'])->name('.simpan');
        Route::get('ubah/{id}', [AdminKategoriController::class, 'ubah'])->name('.ubah');
        Route::get('hapus/{id}', [AdminKategoriController::class, 'hapus'])->name('.hapus');
    });
    Route::prefix('produk')->name('.produk')->group(function(){
        Route::get('/', [AdminProdukController::class, 'index']);
        Route::get('tambah', [AdminProdukController::class, 'tambah'])->name('.tambah');
        Route::get('ubah/{id}', [AdminProdukController::class, 'ubah'])->name('.ubah');
        Route::get('hapus/{id}', [AdminProdukController::class, 'hapus'])->name('.hapus');
        Route::post('simpan', [AdminProdukController::class, 'simpan'])->name('.simpan');
        Route::post('edit', [AdminProdukController::class, 'edit'])->name('.edit');
    });
    Route::prefix('inbox')->name('.inbox')->group(function(){
        Route::get('/');
    });
    Route::prefix('pesanan')->name('.pesanan')->group(function(){
        Route::get('/', [AdminPesananController::class, 'index']);
        Route::get('detail/{id}', [AdminPesananController::class, 'detail'])->name('.detail');
        Route::post('resi', [AdminPesananController::class, 'resi'])->name('.resi');
    });
    Route::prefix('transaksi')->name('.transaksi')->group(function(){
        Route::get('/', [AdminTransaksiController::class, 'index']);
    });
    Route::prefix('retur')->name('.retur')->group(function(){
        Route::get('/', [AdminReturController::class, 'index']);
        Route::get('terima/{id}', [AdminReturController::class, 'terima'])->name('.terima');
        Route::get('tolak/{id}', [AdminReturController::class, 'tolak'])->name('.tolak');
    });
    Route::prefix('laporan')->name('.laporan')->group(function(){
        Route::prefix('pesanan')->name('.pesanan')->group(function(){
            Route::get('/', [AdminLaporanController::class, 'pesanan']);
        });
        Route::prefix('transaksi')->name('.transaksi')->group(function(){
            Route::get('/', [AdminLaporanController::class, 'transaksi']);
        });
        Route::prefix('retur')->name('.retur')->group(function(){
            Route::get('/', [AdminLaporanController::class, 'retur']);
        });
    });
});

require __DIR__.'/auth.php';
