<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crops extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'plating_date',
        'harvest_date',
        'quantity',
    ];
}
