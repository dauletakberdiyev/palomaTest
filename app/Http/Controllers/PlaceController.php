<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\JsonResponse;

final class PlaceController extends Controller
{
    public function index(): JsonResponse
    {
        $places = Place::all();

        return response()->json([
            'message' => 'Places retrieved successfully.',
            'data' => $places
        ]);
    }
}
