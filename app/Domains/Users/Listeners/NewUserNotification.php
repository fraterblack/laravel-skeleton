<?php

namespace Lpf\Domains\Users\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Lpf\Domains\Users\Contracts\ContactRepository;
use Lpf\Domains\Users\Events\NewUserEvent;
use Lpf\Support\Services\Mail\Contracts\MailService;

class NewUserNotification /*implements ShouldQueue*/
{
    protected $mailService;

    /**
     * Create the event handler.
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * Handle the event.
     *
     * @param  NewUserEvent $event
     * @return void
     */
    public function handle(NewUserEvent $event)
    {
        $this->mailService->newUserNotification($event->user, $event->password);
    }
}
