<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of all feedbacks with filtering options
     */
    public function index(Request $request)
    {
        $query = Feedback::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('kategori')) {
            $query->where('kategori_masukan', $request->kategori);
        }

        // Search by nama or nomor telepon
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nomor_telepon', 'like', "%{$search}%");
            });
        }

        $feedbacks = $query->latest()->paginate(10);
        $stats = $this->getFeedbackStats();

        return view('admin.feedback.index', compact('feedbacks', 'stats'));
    }

    /**
     * Show the form for editing feedback status and notes
     */
    public function edit(Feedback $feedback)
    {
        return view('admin.feedback.edit', compact('feedback'));
    }

    /**
     * Update feedback status and admin notes
     */
    public function update(Request $request, Feedback $feedback)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:belum_ditinjau,sedang_ditinjau,sudah_ditindaklanjuti'],
            'catatan_admin' => ['nullable', 'string', 'max:2000'],
        ]);

        $feedback->update($validated);

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback berhasil diperbarui.');
    }

    /**
     * Delete a feedback
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback berhasil dihapus.');
    }

    /**
     * Get feedback statistics
     */
    private function getFeedbackStats()
    {
        return [
            'total' => Feedback::count(),
            'belum_ditinjau' => Feedback::where('status', 'belum_ditinjau')->count(),
            'sedang_ditinjau' => Feedback::where('status', 'sedang_ditinjau')->count(),
            'sudah_ditindaklanjuti' => Feedback::where('status', 'sudah_ditindaklanjuti')->count(),
            'by_kategori' => Feedback::selectRaw('kategori_masukan, count(*) as total')
                ->groupBy('kategori_masukan')
                ->pluck('total', 'kategori_masukan'),
        ];
    }
}
