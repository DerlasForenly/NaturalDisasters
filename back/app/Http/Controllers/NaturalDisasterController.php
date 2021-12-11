<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostNaturalDisasterRequest;

class NaturalDisasterController extends Controller
{
    public function store(PostNaturalDisasterRequest $request) {
        return response()->json([
            'message' => 'Events have been saved to DB'
        ], 200);
    }   
}
