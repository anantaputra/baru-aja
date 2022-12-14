<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
