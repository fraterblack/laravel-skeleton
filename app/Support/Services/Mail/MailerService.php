<?php

namespace Lpf\Support\Services\Mail;

use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Lpf\Support\Services\Mail\Contracts\MailService as MailServiceContract;
use Lpf\Support\Services\Mail\Traits\General as GeneralTrait;

class MailerService implements MailServiceContract
{
    use GeneralTrait;

    protected $mailer;

    public function __construct(MailerContract $mailer)
    {
        $this->mailer = $mailer;
    }
}
