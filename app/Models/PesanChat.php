<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PesanChat extends Model
{
    use HasFactory;
    
    public $primaryKey = 'pc_id';

    protected $table = 'pesan_chat';

    protected $fillable = [
        'pc_room_id',
        'pc_user_initial',
        'pc_nama',
        'pc_pesan',
        'pc_waktu_kirim',
    ];

    public function getDataByRoomId($roomId)
    {
        return $this->where('pc_room_id', $roomId)
                    ->selectRaw('
                        pc_room_id as room_id,
                        pc_user_initial as user_initial,
                        pc_nama as nama,
                        pc_pesan as pesan,
                        pc_waktu_kirim as pesan_created_at
                    ')
                    ->get();
    }

    public function storePesan($roomId, $pesan)
    {
        return $this->create([
            'pc_room_id' => $roomId,
            'pc_user_initial' => Auth::user()->initial,
            'pc_nama' => Auth::user()->name,
            'pc_pesan' => $pesan,
            'pc_waktu_kirim' => date('g:i A', strtotime(now())),
        ]);
    }
}
