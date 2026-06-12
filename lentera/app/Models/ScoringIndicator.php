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
     */
    public static function calculateScore(
        $penghasilan,
        $jumlah_tanggungan,
        $deskripsi_kebutuhan = null,
        $bukti_pendukung = null,
        $status_rumah = null,
        $sktm = null
    ) {
        $totalScore = 0;
        $indicators = self::with('rules')->get();

        $hasPenghasilan = $indicators->contains('column_name', 'penghasilan');
        $hasTanggungan  = $indicators->contains('column_name', 'jumlah_tanggungan');
        $hasStatusRumah = $indicators->contains('column_name', 'status_rumah');
        $hasBuktiPendukung = $indicators->contains('column_name', 'bukti_pendukung');
        $hasSktm = $indicators->contains('column_name', 'sktm');

        $displayIndicators = collect();

        // --- Indikator: Penghasilan ---
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

        // --- Indikator: Jumlah Tanggungan ---
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

        // --- Indikator: Status Rumah ---
        if ($hasStatusRumah) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'status_rumah'));
        } else {
            $statusRumahInd = new self([
                'name'        => 'Status Rumah',
                'column_name' => 'status_rumah',
            ]);
            $statusRumahInd->setRelation('rules', collect([
                new ScoringRule(['operator' => '=', 'value' => 'Sewa/Kontrak', 'score' => 30]),
                new ScoringRule(['operator' => '=', 'value' => 'Numpang', 'score' => 20]),
                new ScoringRule(['operator' => '=', 'value' => 'Milik Sendiri', 'score' => 10]),
            ]));
            $displayIndicators->push($statusRumahInd);
        }

        // --- Indikator: Bukti Pendukung ---
        if ($hasBuktiPendukung) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'bukti_pendukung'));
        } else {
            $buktiPendukungInd = new self([
                'name'        => 'Bukti Pendukung',
                'column_name' => 'bukti_pendukung',
            ]);
            $buktiPendukungInd->setRelation('rules', collect([
                new ScoringRule(['operator' => '=', 'value' => 'Ada', 'score' => 15]),
                new ScoringRule(['operator' => '=', 'value' => 'Tidak Ada', 'score' => 0]),
            ]));
            $displayIndicators->push($buktiPendukungInd);
        }

        // --- Indikator: SKTM ---
        if ($hasSktm) {
            $displayIndicators->push($indicators->firstWhere('column_name', 'sktm'));
        } else {
            $sktmInd = new self([
                'name'        => 'Surat Keterangan Tidak Mampu (SKTM)',
                'column_name' => 'sktm',
            ]);
            $sktmInd->setRelation('rules', collect([
                new ScoringRule(['operator' => '=', 'value' => 'Ada', 'score' => 25]),
                new ScoringRule(['operator' => '=', 'value' => 'Tidak Ada', 'score' => 0]),
            ]));
            $displayIndicators->push($sktmInd);
        }

        // Tambahkan indikator kustom lainnya dari database
        foreach ($indicators as $ind) {
            if (!in_array($ind->column_name, ['penghasilan', 'jumlah_tanggungan', 'status_rumah', 'bukti_pendukung', 'sktm'])) {
                $displayIndicators->push($ind);
            }
        }

        // Map paths/states to standardized string values
        $buktiPendukungVal = $bukti_pendukung;
        if ($buktiPendukungVal !== 'Ada' && $buktiPendukungVal !== 'Tidak Ada') {
            $buktiPendukungVal = !empty($buktiPendukungVal) ? 'Ada' : 'Tidak Ada';
        }

        $sktmVal = $sktm;
        if ($sktmVal !== 'Ada' && $sktmVal !== 'Tidak Ada') {
            $sktmVal = !empty($sktmVal) ? 'Ada' : 'Tidak Ada';
        }

        // Hitung skor dari setiap indikator
        foreach ($displayIndicators as $indicator) {
            $value = null;
            if ($indicator->column_name === 'penghasilan') {
                $value = $penghasilan;
            } elseif ($indicator->column_name === 'jumlah_tanggungan') {
                $value = $jumlah_tanggungan;
            } elseif ($indicator->column_name === 'status_rumah') {
                $value = $status_rumah;
            } elseif ($indicator->column_name === 'bukti_pendukung') {
                $value = $buktiPendukungVal;
            } elseif ($indicator->column_name === 'sktm') {
                $value = $sktmVal;
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

            // Fallback ke aturan default jika tidak ada di database
            if (!$matched) {
                $defaultRules = collect();
                if ($indicator->column_name === 'penghasilan') {
                    $defaultRules = collect([
                        new ScoringRule(['operator' => '<',       'value' => 1000000,                       'score' => 40]),
                        new ScoringRule(['operator' => 'between', 'value' => 1000000, 'value_max' => 3000000, 'score' => 25]),
                        new ScoringRule(['operator' => '>',       'value' => 3000000,                       'score' => 10]),
                    ]);
                } elseif ($indicator->column_name === 'jumlah_tanggungan') {
                    $defaultRules = collect([
                        new ScoringRule(['operator' => '>',       'value' => 3,               'score' => 30]),
                        new ScoringRule(['operator' => 'between', 'value' => 2, 'value_max' => 3, 'score' => 20]),
                        new ScoringRule(['operator' => '<',       'value' => 2,               'score' => 10]),
                    ]);
                } elseif ($indicator->column_name === 'status_rumah') {
                    $defaultRules = collect([
                        new ScoringRule(['operator' => '=', 'value' => 'Sewa/Kontrak', 'score' => 30]),
                        new ScoringRule(['operator' => '=', 'value' => 'Numpang', 'score' => 20]),
                        new ScoringRule(['operator' => '=', 'value' => 'Milik Sendiri', 'score' => 10]),
                    ]);
                } elseif ($indicator->column_name === 'bukti_pendukung') {
                    $defaultRules = collect([
                        new ScoringRule(['operator' => '=', 'value' => 'Ada', 'score' => 15]),
                        new ScoringRule(['operator' => '=', 'value' => 'Tidak Ada', 'score' => 0]),
                    ]);
                } elseif ($indicator->column_name === 'sktm') {
                    $defaultRules = collect([
                        new ScoringRule(['operator' => '=', 'value' => 'Ada', 'score' => 25]),
                        new ScoringRule(['operator' => '=', 'value' => 'Tidak Ada', 'score' => 0]),
                    ]);
                }

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

        return $totalScore;
    }

    /**
     * Evaluate if a value satisfies a specific rule.
     */
    private static function evaluateRule($value, $rule)
    {
        switch ($rule->operator) {
            case '<':
                return (float)$value < (float)$rule->value;
            case '<=':
                return (float)$value <= (float)$rule->value;
            case '>':
                return (float)$value > (float)$rule->value;
            case '>=':
                return (float)$value >= (float)$rule->value;
            case '=':
                return strtolower(trim((string)$value)) === strtolower(trim((string)$rule->value));
            case 'between':
                return (float)$value >= (float)$rule->value && (float)$value <= (float)$rule->value_max;
            default:
                return false;
        }
    }
}
