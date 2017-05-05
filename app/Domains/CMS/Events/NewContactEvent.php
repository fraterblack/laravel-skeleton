<?php

namespace Lpf\Domains\CMS\Events;

use Illuminate\Queue\SerializesModels;
use Lpf\Domains\CMS\Contact;

class NewContactEvent
{
    use SerializesModels;

    public $contact;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
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
