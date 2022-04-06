<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\DelegateController;
use App\Http\Controllers\UniversityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource( 'activity', ActivityController::class );
Route::resource( 'archive', ArchiveController::class );
Route::resource( 'assistance', AssistanceController::class );
Route::resource( 'commission', CommissionController::class );
Route::resource( 'delegate', DelegateController::class );
Route::resource( 'university', UniversityController::class );