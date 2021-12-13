<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasa_id',
        'url',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'pivot',
    ];

    public static function createIfNotExist($data)
    {
        $source = Source::where('nasa_id', $data['nasa_id'])->first();

        if (!$source) {
            $source = Source::create($data);
        }

        return $source;
    }

    public static function createOrFail($data)
    {
        $source = Source::where('nasa_id', $data['nasa_id'])->first();

        if (!$source) {
            $source = Source::create($data);
            return $source;
        }

        return null;
    }

    public function disasters()
    {
        return $this->belongsToMany(NaturalDisaster::class, "disaster_sources");
    }
}
