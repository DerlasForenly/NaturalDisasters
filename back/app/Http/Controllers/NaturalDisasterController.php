<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\PostNaturalDisasterRequest;
use App\Models\Category;
use App\Models\DisasterCategory;
use App\Models\DisasterSource;
use App\Models\NaturalDisaster;
use App\Models\Source;
use App\Models\Geometry;

class NaturalDisasterController extends Controller
{
    public function index()
    {
        return response()->json([
            'events' => NaturalDisaster::all(),
        ], 200);
    }

    public function store(PostNaturalDisasterRequest $request) {
        $countSavedDisasters = 0;

        foreach ($request->events as $event) {
            $disaster = NaturalDisaster::where('nasa_id', $event['id'])->first();

            if ($disaster) {
                foreach ($event['categories'] as $category) {
                    $new_category = Category::createIfNotExist([
                        'title' => $category['title'],
                        'nasa_id' => $category['id']
                    ]);
                    DisasterCategory::create([
                        'natural_disaster_id' => $disaster->id,
                        'category_id' => $new_category->id,
                    ]);
                }
    
                foreach ($event['sources'] as $source) {
                    $new_source = Source::createIfNotExist([
                        'url' => $source['url'],
                        'nasa_id' => $source['id']
                    ]);
                    DisasterSource::create([
                        'natural_disaster_id' => $disaster->id,
                        'source_id' => $new_source->id,
                    ]);
                }
    
                foreach ($event['geometries'] as $geometry) {
                    $new_geometry = Geometry::createIfNotExist([
                        'natural_disaster_id' => $disaster['id'],
                        'date' => $geometry['date'],
                        'type' => $geometry['type'],
                        'lng' => $geometry['coordinates'][0],
                        'lat' => $geometry['coordinates'][1]
                    ]);
                }
            } else {
                $countSavedDisasters++;

                $disaster = NaturalDisaster::create([
                    'title' => $event['title'],
                    'nasa_id' => $event['id'],
                    'description' => $event['description'],
                    'nasa_link' => $event['link'],
                ]);

                foreach ($event['categories'] as $category) {
                    $new_category = Category::createOrFail([
                        'title' => $category['title'],
                        'nasa_id' => $category['id']
                    ]);
                    
                    if ($new_category) {
                        DisasterCategory::createIfNotExist([
                            'natural_disaster_id' => $disaster->id,
                            'category_id' => $new_category->id,
                        ]);
                    }
                }
    
                foreach ($event['sources'] as $source) {
                    $new_source = Source::createOrFail([
                        'url' => $source['url'],
                        'nasa_id' => $source['id']
                    ]);

                    if ($new_source) {
                        DisasterSource::createIfNotExist([
                            'natural_disaster_id' => $disaster->id,
                            'source_id' => $new_source->id,
                        ]);
                    }   
                }
    
                foreach ($event['geometries'] as $geometry) {
                    $new_geometry = Geometry::createIfNotExist([
                        'natural_disaster_id' => $disaster['id'],
                        'date' => $geometry['date'],
                        'type' => $geometry['type'],
                        'lng' => $geometry['coordinates'][0],
                        'lat' => $geometry['coordinates'][1]
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'New saved events: ' . $countSavedDisasters
        ], 200);
    }
}
