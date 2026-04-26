<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;

public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'photo' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('photos', 'public');
    }

    Recipient::create($data);

    return back();
}