<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisasterCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'natural_disaster_id',
        'category_id',
    ];

    public static function createIfNotExist($data)
    {
        $disasterCategory = DisasterCategory::where('category_id', $data['category_id'])
            ->where('natural_disaster_id', $data['natural_disaster_id'])->first();

        if (!$disasterCategory) {
            $disasterCategory = DisasterCategory::create($data);
        }

        return $disasterCategory;
    }

    public static function createOrFail($data)
    {
        $disasterCategory = DisasterCategory::where('category_id', $data['category_id'])
            ->where('natural_disaster_id', $data['natural_disaster_id'])->first();

        if (!$disasterCategory) {
            $disasterCategory = DisasterCategory::create($data);
            return $disasterCategory;
        }

        return null;
    }
}
