<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartisipanPesanChat extends Model
{
    use HasFactory;

    public $primaryKey = 'ppc_id';

    protected $table = 'partisipan_pesan_chat';

    protected $fillable = [
        'ppc_room_id',
        'ppc_user_initial',
        'ppc_user_id',
    ];
}
