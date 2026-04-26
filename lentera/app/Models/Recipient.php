<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    protected $table = 'recipients';

    protected $fillable = [
        'name',
        'income',
        'dependents',
        'house_condition',
        'score'
    ];

    protected static function booted()
    {
        static::saving(function ($r) {
            $score = 0;

            // Penghasilan
            if ($r->income < 1000000) $score += 40;
            elseif ($r->income <= 3000000) $score += 25;
            else $score += 10;

            // Tanggungan
            if ($r->dependents > 3) $score += 30;
            elseif ($r->dependents >= 2) $score += 20;
            else $score += 10;

            // Rumah
            if ($r->house_condition == 'tidak_layak') $score += 30;
            else $score += 10;

            $r->score = $score;
        });
    }
}