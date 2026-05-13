<?php

use App\Http\Controllers\Api\IncidentApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// UiPath Automation Bridge (Step 3)
Route::post('/incidents/store', [IncidentApiController::class, 'store']);
