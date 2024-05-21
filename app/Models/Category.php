<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "categories";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'category_name',
        'description'
    ];

    public function product(): HasMany
    {

        return $this->hasMany(Product::class, 'product_id', 'id');

    }




}
