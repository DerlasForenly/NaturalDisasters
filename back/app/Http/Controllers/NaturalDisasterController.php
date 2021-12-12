<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            'events' => NaturalDisaster::all()
        ], 200);
    }

    public function store(PostNaturalDisasterRequest $request) {
        foreach ($request->events as $event) {
            $disaster = NaturalDisaster::createOrFail([
                'title' => $event['title'],
                'nasa_id' => $event['id'],
                'description' => $event['description'],
                'nasa_link' => $event['link'],
            ]);

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
                        'coordinates' => "[" . $geometry['coordinates'][0] . ", " . $geometry['coordinates'][1] . "]"
                    ]);
                }
            }
        }

        return response()->json([
            'message' => 'Events have been saved to DB',
            'events' => $request->events,
        ], 200);
    }
}
