<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $guarded = [];

    public $incrementing = false;

    protected $primaryKey = 'id_pesanan';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'id_pesanan');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pesanan');
    }

    public function alamat()
    {
        return $this->belongsTo(AlamatUser::class, 'id_alamat');
    }
}
