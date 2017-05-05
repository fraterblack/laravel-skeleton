<?php

namespace Lpf\Domains\CMS;

use Illuminate\Database\Eloquent\Model;
use Lpf\Domains\CMS\Presenters\ContactPresenter;
use Lpf\Domains\Users\User;
use Lpf\Support\ViewPresenter\PresentableTrait;
use OwenIt\Auditing\AuditingTrait;
use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

class Contact extends Model
{
    use AuditingTrait, PresentableTrait, Eloquence, Mappable;

    protected $presenter = ContactPresenter::class;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'sent',
        'replied',
        'ip',
        'city',
        'state',
        'telephone_1',
        'telephone_2',
        'origin',
        'contact_recipient_id',
        'user_id',
    ];

    protected $visible = [
        'created_at',
        'contact_recipient_id',
        'user_id',
        'name',
        'email',
        'telephone_1',
        //'telephone_2',
        'city',
        'state',
        //'subject',
        'message',
        'sent',
        'replied',
        'ip',
        //'origin',
    ];

    protected $maps = [
        'recipient_name' => 'recipient.name',
    ];

    protected $casts = [
        'sent' => 'boolean',
        'replied' => 'boolean'
    ];

    /* Relations */
    public function recipient()
    {
        return $this->belongsTo(ContactRecipient::class, 'contact_recipient_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
