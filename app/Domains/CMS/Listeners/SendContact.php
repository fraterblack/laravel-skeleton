<?php

namespace Lpf\Domains\CMS\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Lpf\Domains\CMS\Contracts\ContactRepository;
use Lpf\Domains\CMS\Events\NewContactEvent;
use Lpf\Support\Services\Mail\Contracts\MailService;

class SendContact implements ShouldQueue
{
    protected $mailService;
    protected $contactRepository;

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct(MailService $mailService,
                                ContactRepository $contactRepository
    ) {
        $this->mailService = $mailService;
        $this->contactRepository = $contactRepository;
    }

    /**
     * Handle the event.
     *
     * @param  NewContactEvent $event
     * @return void
     */
    public function handle(NewContactEvent $event)
    {
        $this->sendConfirmation($event);
    }

    protected function sendConfirmation($event)
    {
        if ($this->mailService->sendContact($event->contact)) {
            //Mark as sent
            $this->contactRepository->update($event->contact, [
               'sent' => 1
            ]);
        }
    }
}
