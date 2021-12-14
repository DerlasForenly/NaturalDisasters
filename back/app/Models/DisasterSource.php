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
    

    public static function createIfNotExist($data)
    {
        $disasterSource = DisasterSource::where('source_id', $data['source_id'])
            ->where('natural_disaster_id', $data['natural_disaster_id'])->first();

        if (!$disasterSource) {
            $disasterSource = DisasterSource::create($data);
        }

        return $disasterSource;
    }

    public static function createOrFail($data)
    {
        $disasterSource = DisasterSource::where('source_id', $data['source_id'])
            ->where('natural_disaster_id', $data['natural_disaster_id'])->first();

        if (!$disasterSource) {
            $disasterSource = DisasterSource::create($data);
            return $disasterSource;
        }

        return null;
    }
}
