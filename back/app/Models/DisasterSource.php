<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'natural_disaster_id',
        'source_id',
    ];
}
