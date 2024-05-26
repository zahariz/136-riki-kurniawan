<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "transactions";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'transaction_code',
        'transaction_type',
        'transaction_date',
        'user_id'
    ];

    public function details(): HasMany
    {

        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');

    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
