<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraService extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'service_name',
        'description',
        'price',
    ];
}
