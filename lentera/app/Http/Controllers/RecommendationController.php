<?php

namespace App\Http\Controllers;

use App\Models\Recipient;

class RecommendationController extends Controller
{
    public function index()
    {
        $data = Recipient::orderByDesc('score')->get();

        return view('recommendation', compact('data'));
    }
}