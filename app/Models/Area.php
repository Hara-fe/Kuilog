<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /** @use HasFactory<\Database\Factories\AreaFactory> */
    use HasFactory;
    protected $fillable = ['name']; // 都道府県や地域名など

    public function shops()
    {
        return $this->hasMany(Shop::class);
    }
}
