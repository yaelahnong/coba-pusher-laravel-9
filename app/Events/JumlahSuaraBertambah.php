<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JumlahSuaraBertambah implements shouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $resumeTerkiniSeluruhIndonesia;
    public $resumeTerkiniProvinsi;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($resumeTerkiniSeluruhIndonesia, $resumeTerkiniProvinsi)
    {
        $this->resumeTerkiniSeluruhIndonesia = $resumeTerkiniSeluruhIndonesia;
        $this->resumeTerkiniProvinsi = $resumeTerkiniProvinsi;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('jumlah-suara');
    }
}
