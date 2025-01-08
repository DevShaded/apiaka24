<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function () {
    // return json response with status code 200 and the version of the project
    return response()->json([
        'message' => 'Dette er API\'en til Aka24. Alle forespørsler må sendes til /api/*',
        'version' =>  '1.0.0'
    ], 200);
});

Route::resource('/posts', PostController::class)->only(['index', 'show']);
