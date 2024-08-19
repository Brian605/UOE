<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    protected $fillable=[
        'source',
        'date',
        'amount',
        'received_by',
    ];
    protected $casts=[
        'date' => 'date'
    ];
}
