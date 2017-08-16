<?php

namespace Lpf\Domains\CMS;

use Artesaos\Attacher\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Lpf\Domains\CMS\Presenters\BannerPresenter;
use Lpf\Support\ViewPresenter\PresentableTrait;
use OwenIt\Auditing\AuditingTrait;

class Banner extends Model
{
    use AuditingTrait, HasImage, PresentableTrait;

    protected $presenter = BannerPresenter::class;

    protected $fillable = [
        'name',
        'type',
        'code',
        'url',
        'open_in_new_window',
        'background_color',
        'active',
        'banner_place_id',
        'availability_from',
        'availability_to',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'availability_from',
        'availability_to',
    ];

    protected $casts = [
        'active' => 'boolean',
        'open_in_new_window' => 'boolean'
    ];

    /* Relations */
    public function place()
    {
        return $this->belongsTo(BannerPlace::class, 'banner_place_id');
    }

    /* Mutator */
    public function setAvailabilityFromAttribute($value)
    {
        if ($value) {
            $this->attributes['availability_from'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $value)->toDateTimeString();
        }
    }

    public function setAvailabilityToAttribute($value)
    {
        if ($value) {
            $this->attributes['availability_to'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $value)->toDateTimeString();
        }
    }
}
