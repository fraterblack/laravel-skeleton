<?php

namespace Lpf\Support\Helpers;

/**
 * Class NumberFormatter.
 *
 * Helps format a number.
 */
class NumberFormatter
{
    /**
     * Formata número para float
     * @param mixed $number
     * @param null|integer $decimals
     * @param boolean $thousandsSeparator
     * @return float|string
     */
    static public function toFloat($number, $decimals = null, $thousandsSeparator = false)
    {
        if (! $decimals) {
            return self::prepareNumberToFormat($number);
        }

        return number_format(self::prepareNumberToFormat($number), $decimals, '.', ($thousandsSeparator ? ',' : ''));
    }

    /**
     * Formata número para o formato real
     * @param mixed $number
     * @param int $decimals
     * @param boolean $thousandsSeparator
     * @return string
     */
    static public function toReal($number, $decimals = 2, $thousandsSeparator = false)
    {
        return number_format(self::prepareNumberToFormat($number), $decimals, ',', ($thousandsSeparator ? '.' : ''));
    }

    /**
     * @param mixed $number
     * @return float
     */
    static protected function prepareNumberToFormat($number)
    {
        if (self::isRealFormat($number)) {
            return (float) str_replace(['.', ','], ['', '.'], $number);
        } else {
            return (float) str_replace(',', '', $number);
        }
    }

    /**
     * @param mixed $number
     * @return bool
     */
    static public function isRealFormat($number)
    {
        if (preg_match('/([0-9,]+\,[0-9]{2})$/', $number)) {
            return true;
        }
    }
}