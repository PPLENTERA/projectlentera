<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class ScoringRule extends Model
{
    protected $table = 'scoring_rules';
    protected $fillable = [
        'scoring_indicator_id',
        'operator',
        'value',
        'value_max',
        'score',
        'label',
    ];
    public function indicator()
    {
        return $this->belongsTo(ScoringIndicator::class, 'scoring_indicator_id');
    }
}
