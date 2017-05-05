<?php

namespace Lpf\Support\Helpers;

class NumberFormatter
{
    static public function toFloat($number, $decimals = 2, $thousandsSeparator = '')
    {
        return number_format(self::prepareNumberToFormat($number), $decimals, '.', $thousandsSeparator);
    }

    static public function toReal($number, $decimals = 2, $thousandsSeparator = '')
    {
        return number_format(self::prepareNumberToFormat($number), $decimals, ',', $thousandsSeparator);
    }

    static protected function prepareNumberToFormat($number)
    {
        if (self::isRealFormat($number)) {
            return (float) str_replace(['.', ','], ['', '.'], $number);
        } else {
            return (float) str_replace(',', '', $number);
        }
    }

    static public function isRealFormat($number)
    {
        if (preg_match('/([0-9,]+\,[0-9]{2})$/', $number)) {
            return true;
        }
    }
}