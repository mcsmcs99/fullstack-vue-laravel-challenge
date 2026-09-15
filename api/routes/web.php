<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'Full Stack Vue Laravel Challenge API',
    ]);
});
