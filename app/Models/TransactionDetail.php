<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "transaction_details";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'exp_date',
        'prod_date',
        'qty',
        'batch',
        'transaction_id',
        'product_id',
        'sbin_id',
        'sloc_id'
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function sbin(): BelongsTo
    {
        return $this->belongsTo(StorageBin::class, 'sbin_id', 'id');
    }

    public function sloc(): BelongsTo
    {
        return $this->belongsTo(StorageLocation::class, 'sloc_id', 'id');
    }
}
