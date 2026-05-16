<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:200'],
            'nomor_telepon' => ['required', 'numeric'],
            'kategori_masukan' => ['required', 'string', 'max:100'],
            'deskripsi_masukan' => ['required', 'string', 'max:2000'],
        ]);

        Feedback::create($validated);

        return redirect()->route('feedback.create')
            ->with('success', 'Terima kasih, masukan Anda telah dikirim. Kami akan meninjau umpan balik Anda secepatnya.');
    }
}
