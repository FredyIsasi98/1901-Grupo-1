<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->group(function () {
    Route::get('/ventas', function () {
        return response()->json(['message' => 'API funcionando correctamente']);
    });
});
