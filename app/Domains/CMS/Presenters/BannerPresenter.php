<?php

namespace Lpf\Domains\CMS\Presenters;

use Lpf\Domains\CMS\BannerPlace;
use Lpf\Support\ViewPresenter\HasImagePresenterTrait;
use Lpf\Support\ViewPresenter\Presenter;
use Lpf\Support\ViewPresenter\TimestampsPresenterTrait;

class BannerPresenter extends Presenter
{
    use HasImagePresenterTrait, TimestampsPresenterTrait;

    public function availabilityFromDate($format = "d/m/Y H:i:s")
    {
        return ($this->availability_from !== null && $this->availability_from->year > 1) ? $this->availability_from->format($format) : '';
    }

    public function availabilityToDate($format = "d/m/Y H:i:s")
    {
        return ($this->availability_to !== null && $this->availability_to->year > 1) ? $this->availability_to->format($format) : '';
    }

    public function typeName()
    {
        return BannerPlace::types()[$this->type];
    }

    public function typeOfBanner()
    {
        if ($this->type == BannerPlace::TYPE_IMAGE || $this->type == BannerPlace::TYPE_GIF) {
            return 'image';
        } elseif($this->type == BannerPlace::TYPE_HTML) {
            return 'html';
        } else {
            return 'undefined';
        }
    }
}