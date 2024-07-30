<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livestock extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'breed',
        'birth_date',
        'weight',
        'health_status',
        'milk_produce'
    ];
}
