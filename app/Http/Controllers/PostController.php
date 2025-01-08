<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $posts = Cache::remember('published_posts', 3600, function () {
            return Post::with(['category', 'author'])
                ->where('is_published', true)
                ->latest()
                ->get();
        });

        return response()->json([
            'status' => true,
            'data' => [
                'posts' => $posts
            ]
        ], 200);
    }

    public function show(string $slug)
    {
        $post = Cache::remember("post_{$slug}", 3600, function () use ($slug) {
            return Post::with(['category', 'author'])
                ->where('slug', $slug)
                ->where('is_published', true)
                ->firstOrFail();
        });

        return response()->json([
            'status' => true,
            'data' => [
                'post' => $post
            ]
        ], 200);
    }
}
