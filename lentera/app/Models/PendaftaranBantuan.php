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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}