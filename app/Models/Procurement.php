<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'quantity',
        'cost',
        'type',
        'date',
        'payment_mode',
        'transaction_id'
    ];
}
