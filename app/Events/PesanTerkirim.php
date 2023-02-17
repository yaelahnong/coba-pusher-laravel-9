<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PesanTerkirim implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Informasi pengirim
     *
     * @var User
     */
    public $user;

    /**
     * Isi pesan
     *
     * @var Message
     */
    public $pesan;

    /**
     * Specific room id
     *
     * @var Message
     */
    public $roomId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, array $pesan, string $roomId)
    {
        $this->user = $user;
        $this->pesan = $pesan;
        $this->roomId = $roomId;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat');
    }
}
