<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory, Uuids, SoftDeletes;
    
    protected $guarded = [];

    public $incrementing = false;
    
    protected $primaryKey = 'id_produk';

    public function kategorinya()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
