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

    public static function createIfNotExist($data)
    {
        $source = Source::where('nasa_id', $data['nasa_id'])->first();

        if (!$source) {
            $source = Source::create([
                'nasa_id' => $data['nasa_id'],
                'url' => $data['url'],
            ]);
        }

        return $source;
    }
}
