<?php

namespace App\Events;

use App\Models\Order;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class OrderFee implements ShouldBroadcastNow
{
    use SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function broadcastOn()
    {
        return [config('pusher.channel')]; // CHANNEL
    }

    public function broadcastAs()
    {
        return 'order-fee'; // EVENT
    }
}
