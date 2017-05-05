<?php

namespace Lpf\Domains\CMS;

use Artesaos\Attacher\Traits\HasImage;
use Illuminate\Database\Eloquent\Model;
use Lpf\Domains\CMS\Presenters\BannerPlacePresenter;
use Lpf\Support\Domain\Model\DeletableTrait;
use Lpf\Support\ViewPresenter\PresentableTrait;
use OwenIt\Auditing\AuditingTrait;

class BannerPlace extends Model
{
    use AuditingTrait, HasImage, PresentableTrait, DeletableTrait;

    protected $presenter = BannerPlacePresenter::class;

    protected $fillable = [
        'name',
        'description',
        'accepted_types',
        'background_color',
        'width',
        'height',
        'display',
        'limit',
        'active',
        'rand',
    ];

    protected $casts = [
        'accepted_types' => 'array',
        'active' => 'boolean',
        'width' => 'integer',
        'height' => 'integer',
        'display' => 'integer',
        'limit' => 'integer',
    ];

    protected $protectedIds = [1, 2];

    const TYPE_IMAGE = 'image';
    const TYPE_GIF = 'gif';
    const TYPE_HTML = 'html';

    public static $typeTexts = [
        self::TYPE_IMAGE => 'Imagem',
        self::TYPE_GIF => 'Gif',
        self::TYPE_HTML => 'Html',
    ];

    public static function types()
    {
        return self::$typeTexts;
    }

    /* Relations */
    public function banners()
    {
        return $this->hasMany(Banner::class);
    }
}
