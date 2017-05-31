<?php

namespace Lpf\Domains\Users\Events;

use Illuminate\Queue\SerializesModels;
use Lpf\Domains\Users\User;

class NewUserEvent
{
    use SerializesModels;

    public $user;
    public $password;

    /**
     * UpdatedUserEvent constructor.
     * @param User $user
     * @param string $password
     */
    public function __construct(User $user, $password)
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
