<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Message extends Model
{
    use HasFactory;
    
    public $primaryKey = 'ms_id';

    protected $table = 'messages';

    protected $fillable = [
        'ms_in_id',
        'ms_user_id',
        'ms_user_name',
        'ms_message',
        'ms_message_time',
    ];

    public function getMessagesByRoomId($roomId)
    {
        return $this->where('ms_in_id', $roomId)
                    ->selectRaw('
                        ms_in_id as inbox_uid,
                        ms_user_id as user_id,
                        ms_user_name as nama,
                        ms_message as pesan,
                        ms_message_time as pesan_created_at
                    ')
                    ->get();
    }

    public function storePesan($payload)
    {
        return $this->create([
            'ms_in_id' => $payload['inbox_uid'],
            'ms_user_id' => $payload['user_id'],
            'ms_user_name' => $payload['nama'],
            'ms_message' => $payload['pesan'],
            'ms_message_time' => $payload['pesan_created_at'],
        ]);
    }
}
