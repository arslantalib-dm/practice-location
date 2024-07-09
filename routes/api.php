<?php

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\PlaceServiceController;
use App\Http\Controllers\PracticeLocationController;
use App\Http\Controllers\RegionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(["prefix" => "practice"], function () {
    Route::post("/", [PracticeLocationController::class, 'index']);
    Route::post("/add", [PracticeLocationController::class, 'storeFacility']);
    Route::get("/{id}", [PracticeLocationController::class, 'findFacility']);
    Route::post("/update", [PracticeLocationController::class, 'updateFacility']);
    Route::patch("/status", [PracticeLocationController::class, 'statusFacility']);


    //prication locations
    Route::group(['prefix' => 'location'], function () {
        Route::post("/", [PracticeLocationController::class, 'addLocation']);
        Route::patch("/status", [PracticeLocationController::class, 'statusFacilityLocation']);
        Route::get("/{id}", [PracticeLocationController::class, 'findLocation']);
        Route::get("/all/{facilityId}", [PracticeLocationController::class, 'getLocations']);
    });
});

Route::post('file-upload', [FileUploadController::class, 'upload']);
Route::get('signnature-files/{id}/{type}', [FileUploadController::class, 'getSignatureFile']);
Route::delete('delete-file/{id}', [FileUploadController::class, 'deleteFile']);

Route::get('regions', [RegionController::class, 'index']);
Route::get('place-of-service', [PlaceServiceController::class, 'index']);
