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
        $hasStatusRumah = $indicators->contains('column_name', 'status_rumah');
        $hasBuktiPendukung = $indicators->contains('column_name', 'bukti_pendukung');
        $hasSktm = $indicators->contains('column_name', 'sktm');

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
                    'value' => '1000000',
                    'score' => 40,
                    'label' => 'Kurang dari Rp 1.000.000',
                ]),
                new ScoringRule([
                    'operator' => 'between',
                    'value' => '1000000',
                    'value_max' => '3000000',
                    'score' => 25,
                    'label' => 'Rp 1.000.000 - Rp 3.000.000',
                ]),
                new ScoringRule([
                    'operator' => '>',
                    'value' => '3000000',
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
                    'value' => '3',
                    'score' => 30,
                    'label' => 'Lebih dari 3 orang',
                ]),
                new ScoringRule([
                    'operator' => 'between',
                    'value' => '2',
                    'value_max' => '3',
                    'score' => 20,
                    'label' => '2 - 3 orang',
                ]),
                new ScoringRule([
                    'operator' => '<',
                    'value' => '2',
                    'score' => 10,
                    'label' => 'Kurang dari 2 orang',
                ]),
            ]));
            $displayIndicators->push($tanggunganInd);
        }

        // Status Rumah
        if ($hasStatusRumah) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'status_rumah'));
        } else {
            $statusRumahInd = new ScoringIndicator([
                'name' => 'Status Rumah (Default)',
                'column_name' => 'status_rumah',
            ]);
            $statusRumahInd->id = 9993;
            $statusRumahInd->setRelation('rules', collect([
                new ScoringRule([
                    'operator' => '=',
                    'value' => 'Sewa/Kontrak',
                    'score' => 30,
                    'label' => 'Sewa/Kontrak',
                ]),
                new ScoringRule([
                    'operator' => '=',
                    'value' => 'Numpang',
                    'score' => 20,
                    'label' => 'Menumpang (Keluarga/Orang Tua)',
                ]),
                new ScoringRule([
                    'operator' => '=',
                    'value' => 'Milik Sendiri',
                    'score' => 10,
                    'label' => 'Milik Sendiri',
                ]),
            ]));
            $displayIndicators->push($statusRumahInd);
        }

        // Bukti Pendukung
        if ($hasBuktiPendukung) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'bukti_pendukung'));
        } else {
            $buktiPendukungInd = new ScoringIndicator([
                'name' => 'Bukti Pendukung (Default)',
                'column_name' => 'bukti_pendukung',
            ]);
            $buktiPendukungInd->id = 9994;
            $buktiPendukungInd->setRelation('rules', collect([
                new ScoringRule([
                    'operator' => '=',
                    'value' => 'Ada',
                    'score' => 15,
                    'label' => 'Ada Bukti Pendukung',
                ]),
                new ScoringRule([
                    'operator' => '=',
                    'value' => 'Tidak Ada',
                    'score' => 0,
                    'label' => 'Tidak Ada Bukti Pendukung',
                ]),
            ]));
            $displayIndicators->push($buktiPendukungInd);
        }

        // SKTM
        if ($hasSktm) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'sktm'));
        } else {
            $sktmInd = new ScoringIndicator([
                'name' => 'Surat Keterangan Tidak Mampu (SKTM) (Default)',
                'column_name' => 'sktm',
            ]);
            $sktmInd->id = 9995;
            $sktmInd->setRelation('rules', collect([
                new ScoringRule([
                    'operator' => '=',
                    'value' => 'Ada',
                    'score' => 25,
                    'label' => 'Ada SKTM',
                ]),
                new ScoringRule([
                    'operator' => '=',
                    'value' => 'Tidak Ada',
                    'score' => 0,
                    'label' => 'Tidak Ada SKTM',
                ]),
            ]));
            $displayIndicators->push($sktmInd);
        }

        // Add any other custom indicators if present in the database
        foreach ($indicators as $ind) {
            if (!in_array($ind->column_name, ['penghasilan', 'jumlah_tanggungan', 'status_rumah', 'bukti_pendukung', 'sktm'])) {
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
            'column_name' => 'required|string|in:penghasilan,jumlah_tanggungan,status_rumah,bukti_pendukung,sktm',
            'rules' => 'required|array|min:1',
            'rules.*.operator' => 'required|string|in:<,<=,>,>=,=,between',
            'rules.*.value' => 'required|string|max:255',
            'rules.*.value_max' => 'nullable|string|max:255',
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
            'column_name' => 'required|string|in:penghasilan,jumlah_tanggungan,status_rumah,bukti_pendukung,sktm',
            'rules' => 'required|array|min:1',
            'rules.*.operator' => 'required|string|in:<,<=,>,>=,=,between',
            'rules.*.value' => 'required|string|max:255',
            'rules.*.value_max' => 'nullable|string|max:255',
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
