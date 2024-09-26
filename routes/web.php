<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeWebController;

Route::get('health', fn () => response()->json([
    'status' => 'ok', 'working' => true,
    ])
);

foreach (File::allFiles(__DIR__ . '/RoutesWeb') as $partial) {
    Route::prefix('/')->group($partial->getPathname());
}
Route::get('home', [HomeWebController::class, 'index'])->name('home.index');
