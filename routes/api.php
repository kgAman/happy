<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OcrController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| All routes here are prefixed with /api
| Example: POST /api/extract-fields
|--------------------------------------------------------------------------
*/

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'service' => 'image-to-fields',
        'timestamp' => now()
    ]);
});

// OCR → Field Extraction
Route::post('/extract-fields', [OcrController::class, 'extract']);

/*
|--------------------------------------------------------------------------
| Optional: Protected Routes (If needed later)
|--------------------------------------------------------------------------
| Uncomment when you add auth (Sanctum / JWT)
|--------------------------------------------------------------------------
|
| Route::middleware('auth:sanctum')->group(function () {
|     Route::post('/extract-fields', [OcrController::class, 'extract']);
| });
|
*/
