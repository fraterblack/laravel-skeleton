<?php

namespace Lpf\Domains\CMS;

use Illuminate\Database\Eloquent\Model;
use Lpf\Support\Domain\Model\DeletableTrait;
use OwenIt\Auditing\AuditingTrait;

class Page extends Model
{
    use AuditingTrait, DeletableTrait;

    protected $fillable = [
        'title',
        'text',
        'slug',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    /* Set ids to protect */
    protected $protectedIds = [];
}
