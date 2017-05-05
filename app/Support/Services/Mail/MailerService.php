<?php

namespace Lpf\Support\Services\Mail;

use Illuminate\Contracts\Mail\Mailer as MailerContract;
use Lpf\Support\Services\Mail\Contracts\MailService as MailServiceContract;
use Lpf\Support\Services\Mail\Traits\Checkout as CheckoutTrait;
use Lpf\Support\Services\Mail\Traits\Contest as ContestTrait;
use Lpf\Support\Services\Mail\Traits\General as GeneralTrait;
use Lpf\Support\Services\Mail\Traits\Profile as ProfileTrait;
use Lpf\Support\Services\Mail\Traits\Reward as RewardTrait;

class MailerService implements MailServiceContract
{
    use GeneralTrait;

    protected $mailer;

    public function __construct(MailerContract $mailer)
    {
        $this->mailer = $mailer;
    }
}