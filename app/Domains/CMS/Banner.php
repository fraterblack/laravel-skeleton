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
        'created_at',
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
    public function setCreatedAtAttribute($value)
    {
        if ($value) {
            $this->attributes['created_at'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $value)->toDateTimeString();
        }
    }
}
