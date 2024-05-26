<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StorageBin extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "storage_bins";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'kode_bin',
        'nama_bin'
    ];

    public function warehouse(): HasMany
    {
        return $this->hasMany(WarehouseManagement::class, 'sbin_id', 'id');
    }
}
