<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanPenyalahgunaan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penyalahgunaan';

    protected $fillable = [
        'user_id',
        'deskripsi_kejadian',
        'lokasi_kejadian',
        'bukti_path',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}