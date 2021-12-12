<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geometry extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'type',
        'coordinates',
        'natural_disaster_id',
    ];

    public static function createIfNotExist($data)
    {
        $geometry = Geometry::where('natural_disaster_id', $data['natural_disaster_id'])->where('date', $data['date'])->first();

        if (!$geometry) {
            $geometry = Geometry::create($data);
        }

        return $geometry;
    }
}
