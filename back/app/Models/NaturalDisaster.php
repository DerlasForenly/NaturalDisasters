<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NaturalDisaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasa_id',
        'title',
        'status',
        'description',
        'nasa_link',
    ];
}
