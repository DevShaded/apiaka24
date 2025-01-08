<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Cache::remember('categories', 3600, function () {
            return Category::where('is_published', true)
                ->pluck('name', 'id');
        });

        return response()->json([
            'status' => true,
            'data' => [
                'categories' => $categories
            ]
        ], 200);
    }

    public function show(string $name)
    {
        $category = Cache::remember("category_{$name}", 3600, function () use ($name) {
            return Category::where('name', $name)
                ->where('is_published', true)
                ->get();
        });

        if (count($category) === 0 || !$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'category' => $category
            ]
        ], 200);
    }
}
