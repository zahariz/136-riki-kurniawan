<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageLocation extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "storage_locations";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'kode_sloc',
        'nama_sloc'
    ];
}
