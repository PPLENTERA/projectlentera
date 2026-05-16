<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranBantuan extends Model
{
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tanggal_lahir',
        'nik',
        'nomor_kk',
        'nomor_hp',
        'jenis_kelamin',
        'alamat_lengkap',
        'pekerjaan',
        'penghasilan_per_bulan',
        'pengeluaran_bulanan',
        'jumlah_tanggungan',
        'status_rumah',
        'dokumen_ktp',
        'dokumen_kk',
        'dokumen_rumah',
        'dokumen_sktm',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
