<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehouseManagement extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "warehouse_management";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'exp_date',
        'prod_date',
        'qty',
        'batch',
        'product_id',
        'sbin_id',
        'sloc_id'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function sloc(): BelongsTo
    {
        return $this->belongsTo(StorageLocation::class, 'sloc_id', 'id');
    }

    public function sbin(): BelongsTo
    {
        return $this->belongsTo(StorageBin::class, 'sbin_id', 'id');
    }
}
