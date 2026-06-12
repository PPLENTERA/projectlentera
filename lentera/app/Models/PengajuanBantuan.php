<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanBantuan extends Model
{
    protected $table = 'pengajuan_bantuan';
    protected $primaryKey = 'id_pengajuan';

    protected $fillable = [
    'id_users',
    'nama_lengkap',
    'nik',
    'jenis_bantuan',
    'jumlah_tanggungan',
    'penghasilan',
    'deskripsi_kebutuhan',
    'bukti_pendukung',
    'status_pengajuan',
    'tanggal_pengajuan',
    'skor_kelayakan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenPengajuan::class, 'id_pengajuan');
    }

    public function validasi()
    {
        return $this->hasOne(ValidasiVerifikasi::class, 'id_pengajuan');
    }
}