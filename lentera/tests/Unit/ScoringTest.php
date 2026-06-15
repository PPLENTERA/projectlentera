<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\ScoringIndicator;
use App\Models\ScoringRule;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ScoringTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test default scoring calculation when database is empty (fallback rules).
     */
    public function test_calculate_score_with_default_fallback_rules(): void
    {
        // Case 1: All conditions met with max scores + deskripsi kebutuhan >= 20 characters
        // Expected: 
        // - Penghasilan < 1M (40)
        // - Tanggungan > 3 (30)
        // - Status Rumah = Sewa/Kontrak (30)
        // - Bukti Pendukung = Ada (15)
        // - SKTM = Ada (25)
        // - Deskripsi >= 20 chars (+10)
        // Total = 40 + 30 + 30 + 15 + 25 + 10 = 150
        $score1 = ScoringIndicator::calculateScore(
            500000, 
            4, 
            'Saya butuh bantuan pangan dan medis segera', 
            'Ada', 
            'Sewa/Kontrak', 
            'Ada'
        );
        $this->assertEquals(150, $score1);

        // Case 2: Intermediate values, shorter description
        // Expected:
        // - Penghasilan between 1M - 3M (25)
        // - Tanggungan between 2 - 3 (20)
        // - Status Rumah = Numpang (20)
        // - Bukti Pendukung = Tidak Ada (0)
        // - SKTM = Tidak Ada (0)
        // - Deskripsi < 20 chars (0)
        // Total = 25 + 20 + 20 + 0 + 0 + 0 = 65
        $score2 = ScoringIndicator::calculateScore(
            2000000, 
            2, 
            'Pendek', 
            'Tidak Ada', 
            'Numpang', 
            'Tidak Ada'
        );
        $this->assertEquals(65, $score2);

        // Case 3: High income, few dependents, owns home
        // Expected:
        // - Penghasilan > 3M (10)
        // - Tanggungan < 2 (10)
        // - Status Rumah = Milik Sendiri (10)
        // - Bukti Pendukung = Tidak Ada (0)
        // - SKTM = Tidak Ada (0)
        // - Deskripsi null (0)
        // Total = 10 + 10 + 10 + 0 + 0 + 0 = 30
        $score3 = ScoringIndicator::calculateScore(
            4000000, 
            1, 
            null, 
            null, 
            'Milik Sendiri', 
            null
        );
        $this->assertEquals(30, $score3);
    }

    /**
     * Test scoring calculation with custom rules configured in the database.
     */
    public function test_calculate_score_with_database_configured_rules(): void
    {
        // Seed custom indicator and rules
        $incomeIndicator = ScoringIndicator::create([
            'name' => 'Penghasilan Kustom',
            'column_name' => 'penghasilan',
        ]);

        // Custom Rule: if income < 1,500,000 get 50 points
        $incomeIndicator->rules()->create([
            'operator' => '<',
            'value' => '1500000',
            'score' => 50,
        ]);

        // Custom Rule: if income >= 1,500,000 get 15 points
        $incomeIndicator->rules()->create([
            'operator' => '>=',
            'value' => '1500000',
            'score' => 15,
        ]);

        // Call calculateScore with 1,200,000 income
        // Expected score for income: 50 (instead of default 25 for 1.2M)
        // Tanggungan: 1 (default < 2 -> 10)
        // Total = 50 + 10 = 60
        $score = ScoringIndicator::calculateScore(
            1200000, 
            1, 
            null, 
            null, 
            null, 
            null
        );

        $this->assertEquals(60, $score);
    }
}
