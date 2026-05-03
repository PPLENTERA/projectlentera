<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanBantuan extends Model
{
    protected $table = 'pengajuan_bantuan';
    protected $primaryKey = 'id_pengajuan';

    protected $fillable = [
        'id_users',
        'jenis_bantuan',
        'jumlah_tanggungan',
        'penghasilan',
        'deskripsi_kebutuhan',
        'status_pengajuan',
        'tanggal_pengajuan',
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