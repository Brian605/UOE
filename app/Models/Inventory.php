<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "unit_id",
        "quantity",
        "approved_by"
    ];

    public function unit()
    {
        return $this->belongsTo(Units::class);
    }
}
