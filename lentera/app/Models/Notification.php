<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = [
        'user_id',
        'id_pengajuan',
        'title',
        'message',
        'status_before',
        'status_after',
        'is_read',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pengajuan()
    {
        return $this->belongsTo(PengajuanBantuan::class, 'id_pengajuan');
    }
}