<?php

use Illuminate\Support\Facades\Route;
use App\Models\Recipient;

// HITUNG ULANG SEMUA (sekali jalan)
Route::get('/hitung', function () {
    $data = Recipient::all();

    foreach ($data as $d) {
        $d->save(); // trigger auto scoring
    }

    return "OK";
});

// LIHAT RANKING
Route::get('/ranking', function () {
    $data = Recipient::orderByDesc('score')->get();

    foreach ($data as $d) {
        echo $d->name . " | Skor: " . $d->score . "<br>";
    }
});

use App\Http\Controllers\RecommendationController;

Route::get('/rekomendasi', [RecommendationController::class, 'index']);

use App\Http\Controllers\RecipientController;

Route::post('/recipient/store', [RecipientController::class, 'store']);