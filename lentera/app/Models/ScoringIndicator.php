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
    public static function calculateScore($penghasilan, $jumlah_tanggungan)
    {
        $totalScore = 0;
        $indicators = self::with('rules')->get();
        foreach ($indicators as $indicator) {
            $value = null;
            if ($indicator->column_name === 'penghasilan') {
                $value = $penghasilan;
            } elseif ($indicator->column_name === 'jumlah_tanggungan') {
                $value = $jumlah_tanggungan;
            }
            if ($value === null) {
                continue;
            }
            // Find matching rule for this value
            foreach ($indicator->rules as $rule) {
                if (self::evaluateRule($value, $rule)) {
                    $totalScore += $rule->score;
                    break; // Use the first matching rule for this indicator
                }
            }
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
