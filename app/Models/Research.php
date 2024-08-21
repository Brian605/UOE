<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'banner',
        'published',
        'sponsors',
        'duration',
        'start_date',
        'end_date',
        'status',
        'category_id',
        'cost'
    ];
    protected $casts=[
        'start_date' => 'date',
        'end_date' => 'date',
        'published' => 'boolean',
        'sponsors' => 'array',
    ];
}
