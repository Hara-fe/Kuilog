<?php

// app/Models/Shop.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'information',
        'filename',
        'active',
        'category_id',
        'area_id',
        'local',
        'on_off',
        'owner_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasmany(Review::class);
    }

}
