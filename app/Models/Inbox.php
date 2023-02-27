<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Inbox extends Model
{
    use HasFactory;

    public $primaryKey = 'in_id';

    protected $table = 'inbox';

    protected $fillable = [
        'in_id',
        'in_last_message',
        'in_last_message_time',
        'in_last_sent_user_id',
    ];

    /**
     * Checks if room is not found
     *
     * @return bool
     *
     */
    public function roomNotFound($roomId): bool
    {
        $room = $this->select('in_id')->where('in_id', $roomId)->first();

        return $room === null;
    }

    function updateRoom($roomId, $pesan)
    {
        return $this->where('in_id', $roomId)->update([
            'in_last_message' => $pesan,
            'in_last_message_time' => date('g:i A', strtotime(now())),
            'in_last_sent_user_id' => Auth::user()->id,
        ]);
    }
}
