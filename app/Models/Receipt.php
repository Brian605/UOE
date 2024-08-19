<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;
    protected $fillable=[
        'ref_number',
        'date',
        'amount',
        'description',
    ];
    protected $casts=[
        'date'=>'date',
    ];
}
