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

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'categories',
        'sources',
        'geometries',
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
                //'status' => $data['status'],
            ]);
        }

        return $naturalDisaster;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, "disaster_categories");
    }

    public function sources()
    {
        return $this->belongsToMany(Source::class, "disaster_sources");
    }

    public function geometries()
    {
        return $this->hasMany(Geometry::class);
    }
}
