<?php

namespace App\Utils;

class Tools
{
    /**
     * @param string|null $price
     *
     * @return bool
     */
    public static function isNumberDecimal(?string $price): bool
    {
        if (!$price) {
            return false;
        }
        $price = str_replace(',', '.', $price);

        return (!($price != '') || is_numeric($price));
    }

    /**
     * @param string $price
     * @return float
     */
    public static function roundNumber(string $price): float
    {
        $price = str_replace(',', '.', $price);

        return round((float) $price, 2);
    }
}
