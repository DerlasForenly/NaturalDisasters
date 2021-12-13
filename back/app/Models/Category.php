<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasa_id',
        'title',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'pivot',
    ];

    public static function createIfNotExist($data)
    {
        $category = Category::where('nasa_id', $data['nasa_id'])->first();

        if (!$category) {
            $category = Category::create($data);
        }

        return $category;
    }

    public static function createOrFail($data)
    {
        $category = Category::where('nasa_id', $data['nasa_id'])->first();

        if (!$category) {
            $category = Category::create($data);
            return $category;
        }

        return null;
    }


    public function disasters()
    {
        return $this->belongsToMany(NaturalDisaster::class, "disaster_categories");
    }
}
