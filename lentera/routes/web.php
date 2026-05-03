<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Recipient;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\RecipientController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing-page-lentera', [
        'totalDana' => 12400000000000,
        'totalPenerima' => Recipient::count(),
    ]);
});

/*
|--------------------------------------------------------------------------
| Hitung Ulang Score
|--------------------------------------------------------------------------
*/
Route::get('/hitung', function () {
    $data = Recipient::all();

    foreach ($data as $d) {
        $d->save();
    }

    return "OK";
});

/*
|--------------------------------------------------------------------------
| Ranking
|--------------------------------------------------------------------------
*/
Route::get('/ranking', function () {
    $data = Recipient::orderByDesc('score')->get();

    foreach ($data as $d) {
        echo $d->name . " | Skor: " . $d->score . "<br>";
    }
});

/*
|--------------------------------------------------------------------------
| Recommendation
|--------------------------------------------------------------------------
*/
Route::get('/rekomendasi', [RecommendationController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Store Recipient
|--------------------------------------------------------------------------
*/
Route::post('/recipient/store', [RecipientController::class, 'store']);