<?php

namespace Lpf\Support\ViewPresenter;

trait OrderFormatPresenterTrait
{
    use PricePresenterTrait;

    public function shippingFormatted($showSymbol = false, $compact = false)
    {
        $numberFormatted = ($compact) ? number_format($this->shipping, 0, ',', '') : number_format($this->shipping, 2, ',', '');

        if ($showSymbol) {
            return 'R$ ' . $numberFormatted;
        } else {
            return $numberFormatted;
        }
    }

    public function discountFormatted($showSymbol = false, $compact = false)
    {
        $numberFormatted = ($compact) ? number_format($this->discount, 0, ',', '') : number_format($this->discount, 2, ',', '');

        if ($showSymbol) {
            return 'R$ ' . $numberFormatted;
        } else {
            return $numberFormatted;
        }
    }
}