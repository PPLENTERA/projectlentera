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

        $hasPenghasilan = $indicators->contains('column_name', 'penghasilan');
        $hasTanggungan = $indicators->contains('column_name', 'jumlah_tanggungan');

        $displayIndicators = collect();

        // Penghasilan
        if ($hasPenghasilan) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'penghasilan'));
        } else {
            $penghasilanInd = new ScoringIndicator([
                'name' => 'Penghasilan (Default)',
                'column_name' => 'penghasilan',
            ]);
            $penghasilanInd->id = 9991;
            $penghasilanInd->setRelation('rules', collect([
                new ScoringRule([
                    'operator' => '<',
                    'value' => 1000000,
                    'score' => 40,
                    'label' => 'Kurang dari Rp 1.000.000',
                ]),
                new ScoringRule([
                    'operator' => 'between',
                    'value' => 1000000,
                    'value_max' => 3000000,
                    'score' => 25,
                    'label' => 'Rp 1.000.000 - Rp 3.000.000',
                ]),
                new ScoringRule([
                    'operator' => '>',
                    'value' => 3000000,
                    'score' => 10,
                    'label' => 'Lebih dari Rp 3.000.000',
                ]),
            ]));
            $displayIndicators->push($penghasilanInd);
        }

        // Tanggungan
        if ($hasTanggungan) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'jumlah_tanggungan'));
        } else {
            $tanggunganInd = new ScoringIndicator([
                'name' => 'Jumlah Tanggungan (Default)',
                'column_name' => 'jumlah_tanggungan',
            ]);
            $tanggunganInd->id = 9992;
            $tanggunganInd->setRelation('rules', collect([
                new ScoringRule([
                    'operator' => '>',
                    'value' => 3,
                    'score' => 30,
                    'label' => 'Lebih dari 3 orang',
                ]),
                new ScoringRule([
                    'operator' => 'between',
                    'value' => 2,
                    'value_max' => 3,
                    'score' => 20,
                    'label' => '2 - 3 orang',
                ]),
                new ScoringRule([
                    'operator' => '<',
                    'value' => 2,
                    'score' => 10,
                    'label' => 'Kurang dari 2 orang',
                ]),
            ]));
            $displayIndicators->push($tanggunganInd);
        }

        // Add any other custom indicators if present in the database
        foreach ($indicators as $ind) {
            if ($ind->column_name !== 'penghasilan' && $ind->column_name !== 'jumlah_tanggungan') {
                $displayIndicators->push($ind);
            }
        }

        $indicators = $displayIndicators;

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
