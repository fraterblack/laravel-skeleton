<?php

namespace Lpf\Support\ViewPresenter;

use Lpf\Support\Helpers\MoneyHelper;

trait PricePresenterTrait
{
    public function formattedPrice($showSymbol = false, $compact = false, $separeThousands = true)
    {
        $helper = new MoneyHelper($this->price);

        return $helper->toRealFormat($showSymbol, $compact, $separeThousands);
    }
}