<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CognitiveHatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cognitive-hat', [CognitiveHatController::class, 'index'])->name('cognitive-hat.index');
Route::post('/cognitive-hat/analyze', [CognitiveHatController::class, 'analyze'])->name('cognitive-hat.analyze');
