<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $primaryKey = "id";
    protected $keyType = "int";
    protected $table = "roles";
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'desc'
    ];

    public function users(): HasMany
    {

        return $this->hasMany(User::class, 'role_id', 'id');

    }
}
