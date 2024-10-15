<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

final class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        $categories = Category::all();

        return response()->json([
            'message' => 'Categories successfully retrieved',
            'data' => $categories->load('products')
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        return response()->json([
            'message' => 'Category successfully retrieved',
            'data' => $category->load('products')
        ]);
    }
}
