<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/events",[ApiController::class,"getEvent"])->name("getEvent");
Route::post("/events",[ApiController::class,"postEvent"])->name("postEvent");