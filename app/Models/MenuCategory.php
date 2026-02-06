<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable = [
        'name',
        'item_type',
        'is_active',
        'sort_order'
    ];

    // Relation
    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'category_id');
    }

    // Type text accessor
    public function getTypeTextAttribute()
    {
        return [
            1 => 'Food',
            2 => 'Drink',
            3 => 'Dessert'
        ][$this->item_type] ?? 'Unknown';
    }
}
