<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmPlans extends Model
{
    use HasFactory;

    protected $fillable = [
        'objective',
        'layout',
        'infrastructure',
        'location',
        'farm_size'
    ];
}
