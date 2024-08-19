<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceRecord extends Model
{
    use HasFactory;
    protected $fillable=[
        'type',
        'date',
        'category_id',
        'item',
        'description',
        'cost'
    ];
    protected $casts=[
        'date'=>'date',
    ];
}
