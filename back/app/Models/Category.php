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

    public static function createIfNotExist($data)
    {
        $category = Category::where('nasa_id', $data['nasa_id'])->first();

        if (!$category) {
            $category = Category::create([
                'nasa_id' => $data['nasa_id'],
                'title' => $data['title'],
            ]);
        }

        return $category;
    }

    public function disasters()
    {
        return $this->belongsToMany(NaturalDisaster::class, "disaster_categories");
    }
}
