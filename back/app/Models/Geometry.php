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
        'lng',
        'lat',
        'natural_disaster_id',
    ];

    protected $hidden = [
        'id',
        'lat',
        'lng',
        'created_at',
        'updated_at',
    ];

    protected $appends = [
        'coordinates'
    ];

    public static function createIfNotExist($data)
    {
        $geometry = Geometry::where('natural_disaster_id', $data['natural_disaster_id'])->where('date', $data['date'])->first();

        if (!$geometry) {
            $geometry = Geometry::create($data);
        }

        return $geometry;
    }

    public function getCoordinatesAttribute()
    {
        return [$this->lat, $this->lng];
    }   
}
