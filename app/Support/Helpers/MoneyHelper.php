<?php

namespace Lpf\Support\Helpers;

/**
 * Class MoneyHelper.
 *
 */
class MoneyHelper
{
    /**
     * @var float
     */
    protected $number;

    /**
     * MoneyHelper constructor.
     *
     * @param float $number
     *
     * @return $this
     */
    public function __construct($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function toRealFormat($showSymbol = false, $compact = false, $separeThousands = true)
    {
        $formattedNumber = number_format($this->number, ($compact ? 0 : 2), ',', ($separeThousands ? '.' : ''));

        return ($showSymbol ? 'R$ ' : '') . $formattedNumber;
    }

    public function format($compact = false, $separeThousands = true)
    {
        $formattedNumber = number_format($this->number, ($compact ? 0 : 2), ',', ($separeThousands ? '.' : ''));

        return $formattedNumber;
    }
}
