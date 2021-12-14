<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;
use App\Models\DisasterCategory;
use App\Models\DisasterSource;
use App\Models\NaturalDisaster;
use App\Models\Source;
use App\Models\Geometry;

class UpdateDisasters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disasters:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets new disasters from NASA API and saves it to DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::acceptJson()->get('https://eonet.gsfc.nasa.gov/api/v2.1/events', [
            'api_key' => env('NASA_API_KEY'),
            'limit' => 5
        ]);

        foreach ($response->events as $event) {
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

        return Command::SUCCESS;
    }
}
