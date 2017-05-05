<?php

namespace Lpf\Support\ViewPresenter;

trait TimestampsPresenterTrait
{
    public function creationDate($format = "d/m/Y")
    {
        return (!$this->created_at || $this->created_at->year < 1) ? '' : $this->created_at->format($format);
    }

    public function updateDate($format = "d/m/Y")
    {
        return (!$this->updated_at || $this->updated_at->year < 1) ? '' : $this->updated_at->format($format);
    }
}