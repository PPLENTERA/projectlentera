<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ScoringIndicator;
use App\Models\ScoringRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ScoringIndicatorController extends Controller
{
    public function index()
    {
        $indicators = ScoringIndicator::with('rules')->get();
        return view('admin.scoring_indicators.index', compact('indicators'));
    }
    public function create()
    {
        return view('admin.scoring_indicators.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'column_name' => 'required|string|in:penghasilan,jumlah_tanggungan',
            'rules' => 'required|array|min:1',
            'rules.*.operator' => 'required|string|in:<,<=,>,>=,=,between',
            'rules.*.value' => 'required|numeric|min:0',
            'rules.*.value_max' => 'nullable|numeric|min:0',
            'rules.*.score' => 'required|integer|min:0',
            'rules.*.label' => 'nullable|string|max:255',
        ]);
        DB::transaction(function () use ($request) {
            $indicator = ScoringIndicator::create([
                'name' => $request->name,
                'column_name' => $request->column_name,
            ]);
            foreach ($request->rules as $ruleData) {
                $indicator->rules()->create($ruleData);
            }
        });
        return redirect()->route('admin.scoring_indicators.index')
            ->with('success', 'Indikator scoring berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $indicator = ScoringIndicator::with('rules')->findOrFail($id);
        return view('admin.scoring_indicators.edit', compact('indicator'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'column_name' => 'required|string|in:penghasilan,jumlah_tanggungan',
            'rules' => 'required|array|min:1',
            'rules.*.operator' => 'required|string|in:<,<=,>,>=,=,between',
            'rules.*.value' => 'required|numeric|min:0',
            'rules.*.value_max' => 'nullable|numeric|min:0',
            'rules.*.score' => 'required|integer|min:0',
            'rules.*.label' => 'nullable|string|max:255',
        ]);
        $indicator = ScoringIndicator::findOrFail($id);
        DB::transaction(function () use ($request, $indicator) {
            $indicator->update([
                'name' => $request->name,
                'column_name' => $request->column_name,
            ]);
            // Recreate rules (simplest and most robust way)
            $indicator->rules()->delete();
            foreach ($request->rules as $ruleData) {
                $indicator->rules()->create($ruleData);
            }
        });
        return redirect()->route('admin.scoring_indicators.index')
            ->with('success', 'Indikator scoring berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $indicator = ScoringIndicator::findOrFail($id);
        $indicator->delete();
        return redirect()->route('admin.scoring_indicators.index')
            ->with('success', 'Indikator scoring berhasil dihapus!');
    }
}
