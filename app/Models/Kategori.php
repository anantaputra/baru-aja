<?php

namespace App\Models;

use Emadadly\LaravelUuid\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $guarded = [];

    public $incrementing = false;

    protected $primaryKey = 'id_kategori';
}
