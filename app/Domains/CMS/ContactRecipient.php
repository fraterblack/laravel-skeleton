<?php

namespace Lpf\Domains\CMS;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class ContactRecipient extends Model
{
    use AuditingTrait;

    protected $fillable = [
        'name',
        'email',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}
