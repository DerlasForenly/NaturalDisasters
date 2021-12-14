<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Category;

class UpdateCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'categories:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $response = Http::acceptJson()->get('https://eonet.gsfc.nasa.gov/api/v2.1/categories', [
            'api_key' => env('NASA_API_KEY')
        ]);

        $response = $response->collect('categories');

        foreach($response as $category) {
            $new_category = Category::createIfNotExist([
                'title' => $category['title'],
                'nasa_id' => $category['id']
            ]);
        }

        return Command::SUCCESS;
    }
}
