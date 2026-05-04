<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPengajuan extends Model
{
    protected $table = 'dokumen_pengajuan';
    protected $primaryKey = 'id_dokumen';

    protected $fillable = [
        'id_pengajuan',
        'jenis_dokumen',
        'file_path',
    ];

    // Relasi ke PengajuanBantuan
    public function pengajuan()
    {
        return $this->belongsTo(PengajuanBantuan::class, 'id_pengajuan');
    }
}