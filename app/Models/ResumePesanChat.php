<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResumePesanChat extends Model
{
    use HasFactory;

    public $primaryKey = 'rpc_id';

    protected $table = 'r_pesan_chat';

    protected $fillable = [
        'rpc_room_id',
        'rpc_nama',
        'rpc_foto',
        'rpc_pesan_terbaru',
    ];

    public function getUserChatRoomList()
    {
        return $this->selectRaw('
                        rpc_room_id as room_id,
                        rpc_pesan_terbaru as pesan_terbaru,
                        name as nama,
                        email,
                        avatar as foto,
                        r_pesan_chat.rpc_waktu_kirim_terbaru as pesan_updated_at
                    ')
                    ->joinPartisipanPesanChatUserProfile()
                    ->get();
    }

    public function findRoomByRoomId($roomId)
    {
        return $this->selectRaw('
                        rpc_room_id as room_id,
                        ppc_user_initial as user_initial,
                        rpc_pesan_terbaru as pesan_terbaru,
                        name as nama,
                        avatar as foto,
                        email,
                        users.created_at as user_created_at,
                        r_pesan_chat.updated_at as pesan_updated_at
                    ')
                    ->joinPartisipanPesanChatUserProfile()
                    ->where('rpc_room_id', $roomId)
                    ->first();
    }

    /**
     * Checks if room is not found
     *
     * @return bool
     *
     */
    public function roomNotFound($roomId): bool
    {
        $room = $this->select('rpc_room_id')->where('rpc_room_id', $roomId)->first();

        return $room === null;
    }


    /**
     * Checks if the message sender is not authorized
     *
     * @return void
     *
     */
    public function senderIsNotAuthorized($roomId): bool
    {
        $sender = Auth::user();
        
        $room = $this->select('rpc_room_id')
                    ->where('rpc_room_id', $roomId)
                    ->where('ppc_user_id', $sender->id)
                    ->joinPartisipanPesanChatOnly()
                    ->first();

        return $room === null;
    }

    function updateRoom($roomId, $pesan)
    {
        return $this->where('rpc_room_id', $roomId)->update([
            'rpc_pesan_terbaru' => $pesan,
            'rpc_waktu_kirim_terbaru' => date('g:i A', strtotime(now())),
        ]);
    }

    public function scopeJoinPartisipanPesanChatOnly($q)
    {
        $q->join('partisipan_pesan_chat', 'rpc_room_id', '=', 'ppc_room_id');
    }

    public function scopeJoinPartisipanPesanChatUserProfile($q)
    {
        $q->join('partisipan_pesan_chat', 'rpc_room_id', '=', 'ppc_room_id')
            ->join('users', 'ppc_user_id', '=', DB::raw('users.id'))
            ->where('ppc_user_initial', '!=', Auth::user()->initial);
    }
}
