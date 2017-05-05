<?php

namespace Lpf\Support\ViewPresenter;

trait HasImagePresenterTrait
{
    public function getUrlImageByType($type, $url = 'normal')
    {
        if ($image = $this->images->where('type', $type)->first()) {
            return $image->url($url);
        }

        return null;
    }

    public function getUrlImage($url = 'normal')
    {
        if ($image = $this->image) {
            return $image->url($url);
        }

        return null;
    }
}