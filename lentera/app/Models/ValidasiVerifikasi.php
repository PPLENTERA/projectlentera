<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidasiVerifikasi extends Model
{
    protected $table = 'validasi_verifikasi';
    protected $primaryKey = 'id_validasi';

    protected $fillable = [
        'id_pengajuan',
        'id_admin',
        'status_validasi',
        'catatan',
        'tanggal_verifikasi',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(PengajuanBantuan::class, 'id_pengajuan');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }
}