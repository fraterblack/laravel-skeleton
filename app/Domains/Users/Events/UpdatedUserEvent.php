<?php

namespace Lpf\Domains\Users\Events;

use Illuminate\Queue\SerializesModels;
use Lpf\Domains\Users\User;

class UpdatedUserEvent
{
    use SerializesModels;

    public $user;
    public $password;

    /**
     * UpdatedUserEvent constructor.
     * @param User $user
     * @param null|string $password
     */
    public function __construct(User $user, $password = null)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
