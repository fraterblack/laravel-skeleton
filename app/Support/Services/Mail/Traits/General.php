<?php

namespace Lpf\Support\Services\Mail\Traits;

use Closure;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

trait General
{
    public function sendContact(Model $contact, Closure $callback = null)
    {
        try {
            $this->mailer->send('emails.contact', ['contact' => $contact], function ($m) use ($contact) {
                $emails = explode(',', $contact->recipient->email);
                $emails = array_map('trim', $emails);

                $m->to($emails, $contact->recipient->name)->subject($contact->name . " entrou em contato através do site");
            });
        } catch (ClientException $e) {
            Log::critical($e->getMessage(), [
                'event' => 'Sends contact'
            ]);

            return false;
        }

        return true;
    }
}