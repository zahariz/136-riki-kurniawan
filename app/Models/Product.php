<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "products";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'sku',
        'product_name'
    ];

    public function category(): BelongsTo
    {

        return $this->belongsTo(Category::class, 'category_id', 'id');

    }
}
