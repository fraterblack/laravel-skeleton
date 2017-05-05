<?php

namespace Lpf\Domains\CMS;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class Page extends Model
{
    use AuditingTrait;

    protected $fillable = [
        'title',
        'text',
        'slug',
        'active'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];
}
