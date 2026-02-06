<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'item_name',
        'item_description',
        'price',
        'is_available',
        'menu_image',
    ];

    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->menu_image
            ? asset($this->menu_image)
            : asset('images/no-image.png');
    }
}
