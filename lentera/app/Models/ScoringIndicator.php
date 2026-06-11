<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScoringIndicator extends Model
{
    protected $table = 'scoring_indicators';
    protected $fillable = [
        'name',
        'column_name',
    ];
    public function rules()
    {
        return $this->hasMany(ScoringRule::class, 'scoring_indicator_id');
    }
    /**
     * Calculate score based on active indicators and rules in the database.
     *
     * @param  int|float  $penghasilan         Penghasilan per bulan (dari PendaftaranBantuan)
     * @param  int        $jumlah_tanggungan   Jumlah tanggungan keluarga
     * @param  string|null $deskripsi_kebutuhan Deskripsi pengajuan (opsional, +10 jika diisi ≥ 20 karakter)
     * @param  string|null $bukti_pendukung     Path file bukti pendukung (opsional, +20 jika ada)
     */
    public static function calculateScore(
        $penghasilan,
        $jumlah_tanggungan,
        $deskripsi_kebutuhan = null,
        $bukti_pendukung = null
    ) {
        $totalScore = 0;
        $indicators = self::with('rules')->get();

        $hasPenghasilan = $indicators->contains('column_name', 'penghasilan');
        $hasTanggungan  = $indicators->contains('column_name', 'jumlah_tanggungan');

        $displayIndicators = collect();

        // --- Indikator: Penghasilan (maks 40 poin) ---
        if ($hasPenghasilan) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'penghasilan'));
        } else {
            $penghasilanInd = new self([
                'name'        => 'Penghasilan',
                'column_name' => 'penghasilan',
            ]);
            $penghasilanInd->setRelation('rules', collect([
                new ScoringRule(['operator' => '<',       'value' => 1000000,                  'score' => 40]),
                new ScoringRule(['operator' => 'between', 'value' => 1000000, 'value_max' => 3000000, 'score' => 25]),
                new ScoringRule(['operator' => '>',       'value' => 3000000,                  'score' => 10]),
            ]));
            $displayIndicators->push($penghasilanInd);
        }

        // --- Indikator: Jumlah Tanggungan (maks 30 poin) ---
        if ($hasTanggungan) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'jumlah_tanggungan'));
        } else {
            $tanggunganInd = new self([
                'name'        => 'Jumlah Tanggungan',
                'column_name' => 'jumlah_tanggungan',
            ]);
            $tanggunganInd->setRelation('rules', collect([
                new ScoringRule(['operator' => '>',       'value' => 3,               'score' => 30]),
                new ScoringRule(['operator' => 'between', 'value' => 2, 'value_max' => 3, 'score' => 20]),
                new ScoringRule(['operator' => '<',       'value' => 2,               'score' => 10]),
            ]));
            $displayIndicators->push($tanggunganInd);
        }

        // Tambahkan indikator lain dari DB (selain penghasilan & tanggungan)
        foreach ($indicators as $ind) {
            if ($ind->column_name !== 'penghasilan' && $ind->column_name !== 'jumlah_tanggungan') {
                $displayIndicators->push($ind);
            }
        }

        // Hitung skor dari indikator range (penghasilan & tanggungan)
        foreach ($displayIndicators as $indicator) {
            $value = null;
            if ($indicator->column_name === 'penghasilan') {
                $value = $penghasilan;
            } elseif ($indicator->column_name === 'jumlah_tanggungan') {
                $value = $jumlah_tanggungan;
            }
            if ($value === null) {
                continue;
            }

            $matched = false;
            foreach ($indicator->rules as $rule) {
                if (self::evaluateRule($value, $rule)) {
                    $totalScore += $rule->score;
                    $matched = true;
                    break;
                }
            }

            // Fallback ke aturan default jika tidak ada di DB
            if (!$matched && ($indicator->column_name === 'penghasilan' || $indicator->column_name === 'jumlah_tanggungan')) {
                $defaultRules = $indicator->column_name === 'penghasilan'
                    ? collect([
                        new ScoringRule(['operator' => '<',       'value' => 1000000,                       'score' => 40]),
                        new ScoringRule(['operator' => 'between', 'value' => 1000000, 'value_max' => 3000000, 'score' => 25]),
                        new ScoringRule(['operator' => '>',       'value' => 3000000,                       'score' => 10]),
                    ])
                    : collect([
                        new ScoringRule(['operator' => '>',       'value' => 3,               'score' => 30]),
                        new ScoringRule(['operator' => 'between', 'value' => 2, 'value_max' => 3, 'score' => 20]),
                        new ScoringRule(['operator' => '<',       'value' => 2,               'score' => 10]),
                    ]);

                foreach ($defaultRules as $rule) {
                    if (self::evaluateRule($value, $rule)) {
                        $totalScore += $rule->score;
                        break;
                    }
                }
            }
        }

        // --- Indikator: Deskripsi Kebutuhan (+10 poin) ---
        // Diberikan jika pemohon mengisi deskripsi minimal 20 karakter
        if (!empty($deskripsi_kebutuhan) && mb_strlen(trim($deskripsi_kebutuhan)) >= 20) {
            $totalScore += 10;
        }

        // --- Indikator: Bukti Pendukung (+20 poin) ---
        // Diberikan jika pemohon mengunggah file bukti pendukung
        if (!empty($bukti_pendukung)) {
            $totalScore += 20;
        }

        return $totalScore;
    }
    /**
     * Evaluate if a value satisfies a specific rule.
     */
    private static function evaluateRule($value, $rule)
    {
        switch ($rule->operator) {
            case '<':
                return $value < $rule->value;
            case '<=':
                return $value <= $rule->value;
            case '>':
                return $value > $rule->value;
            case '>=':
                return $value >= $rule->value;
            case '=':
                return $value == $rule->value;
            case 'between':
                return $value >= $rule->value && $value <= $rule->value_max;
            default:
                return false;
        }
    }
}
