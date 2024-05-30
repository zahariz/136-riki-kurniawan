<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function sbin(): HasMany
    {
        return $this->hasMany(StorageBin::class, 'sloc_id', 'id');
    }
}
