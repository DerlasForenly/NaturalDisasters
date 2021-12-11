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

    public static function createIfNotExist($data)
    {
        $naturalDisaster = NaturalDisaster::where('nasa_id', $data['nasa_id'])->first();

        if (!$naturalDisaster) {
            $naturalDisaster = NaturalDisaster::create([
                'title' => $data['title'],
                'nasa_id' => $data['nasa_id'],
                'description' => $data['description'],
                'nasa_link' => $data['nasa_link'],
            ]);
        }

        return $naturalDisaster;
    }
}
