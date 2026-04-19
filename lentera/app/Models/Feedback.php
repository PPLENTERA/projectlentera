<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'nama_lengkap',
        'nomor_telepon',
        'kategori_masukan',
        'deskripsi_masukan',
        'status',
        'catatan_admin',
    ];
}
