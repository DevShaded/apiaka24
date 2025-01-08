<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Cache::remember('authors', 3600, function () {
            return Author::all();
        });

        return response()->json([
            'status' => true,
            'data' => [
                'authors' => $authors
            ]
        ], 200);
    }

    public function show(string $slug)
    {
        $author = Cache::remember("author_{$slug}", 3600, function () use ($slug) {
            return Author::where('slug', $slug)->with('posts')->get();
        });

        if (!$author) {
            return response()->json([
                'status' => false,
                'message' => 'Author not found'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => [
                'author' => $author
            ]
        ], 200);
    }
}
