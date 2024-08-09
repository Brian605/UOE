<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'description',
        'phone',
        'address',
        'department_id',
        'social_media',
        'gender',
    ];

    protected $casts=[
        'social_media' => 'array'
    ];
}
