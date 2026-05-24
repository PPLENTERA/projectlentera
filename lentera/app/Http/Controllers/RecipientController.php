<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipient;

class RecipientController extends Controller
{
    public function create()
    {
        return view('recipient.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'income' => 'nullable|numeric',
            'dependents' => 'nullable|numeric',
            'house_condition' => 'nullable',
            'address' => 'nullable',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        Recipient::create($data);

        return redirect('/rekomendasi');
    }

    public function show($id)
    {
        $data = Recipient::findOrFail($id);

        return view('recipient.detail', compact('data'));
    }

    public function location()
    {
        $data = Recipient::all();

        return view('recipient.location', compact('data'));
    }

    public function saveLocation(Request $request)
    {
        $recipient = Recipient::findOrFail($request->recipient_id);

        $recipient->latitude = $request->latitude;
        $recipient->longitude = $request->longitude;

        $recipient->save();

        return back()->with('success', 'Lokasi berhasil disimpan');
    }
}