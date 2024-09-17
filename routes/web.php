<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


Route::get('health', fn () => response()->json([
    'status' => 'ok', 'working' => true,
    ])
);

foreach (File::allFiles(__DIR__ . '/RoutesWeb') as $partial) {
    Route::prefix('/')->group($partial->getPathname());
}

