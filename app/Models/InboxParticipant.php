<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InboxParticipant extends Model
{
  use HasFactory;

  public $primaryKey = 'ip_id';

  protected $table = 'inbox_participant';

  protected $fillable = [
    'ip_in_id',
    'ip_user_id',
  ];

  /**
   * Checks if the message sender is not authorized
   *
   * @return void
   *
   */
  public function senderIsNotAuthorized($roomId): bool
  {
    $sender = Auth::user();

    $room = $this->select('ip_id')
      ->where('ip_in_id', $roomId)
      ->where('ip_user_id', $sender->id)
      ->joinInboxOnly()
      ->first();

    return $room === null;
  }

  public function getUserChatRoomList()
  {
    return $this->selectRaw('
                        in_id as inbox_uid,
                        in_last_message as pesan_terbaru,
                        name as nama,
                        email,
                        avatar as foto,
                        inbox.in_last_message_time as pesan_updated_at
                    ')
      ->joinInboxUserProfile()
      ->get();
  }

  public function findRoomByRoomId($roomId)
  {
    return $this->selectRaw('
                        in_id as inbox_uid,
                        ip_user_id as user_id,
                        in_last_message as pesan_terbaru,
                        name as nama,
                        avatar as foto,
                        email,
                        users.created_at as user_created_at,
                        inbox.in_last_message_time as pesan_updated_at
                    ')
      ->joinInboxUserProfile()
      ->where('in_id', $roomId)
      ->first();
  }

  public function scopeJoinInboxOnly($q)
  {
    $q->join('inbox', 'in_id', '=', 'ip_in_id');
  }

  public function scopeJoinInboxUserProfile($q)
  {
    $inboxIdList = $this->where('ip_user_id', Auth::user()->id)->select('ip_in_id')->pluck('ip_in_id');

    return $q->whereIn('ip_in_id', $inboxIdList)
      ->where('ip_user_id', '!=', Auth::user()->id)
      ->join('inbox', 'ip_in_id', '=', 'in_id')
      ->join('users', 'ip_user_id', '=', DB::raw('users.id'));
  }
}
