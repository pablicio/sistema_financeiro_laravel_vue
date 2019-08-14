<?php namespace App\Support;

use Carbon\Carbon;

class Convert
{
    public static function negative($money)
    {
        return -$money;
    }


    public static function moneyToDecimal($money)
    {
        return self::getfloat($money);
    }

    public static function decimalToMoney($decimal)
    {
        try {
            return number_format($decimal, 2, ',', '.');
        } catch (\Exception $exception) {
            return $decimal;
        }
    }

    public static function dateToDBFormat($brDate)
    {
        try {
            return Carbon::createFromFormat("d/m/Y", trim($brDate))->toDateString();
        } catch (\Exception $e) {
            return $brDate;
        }
    }

    public static function DBToCarbonFormat($bdDate)
    {
        try {
            if (strstr($bdDate, '-'))
                return Carbon::parse($bdDate);

            return $bdDate;
        } catch (\Exception $e) {
            return $bdDate;
        }
    }

    public static function dateTimeToDBFormat($brDateTime)
    {
        try {
            if (preg_match('/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2}):(\d{2})/', trim($brDateTime))) {
                return Carbon::createFromFormat("d/m/Y H:i:s", trim($brDateTime))->toDateTimeString();
            } else if (preg_match('/(\d{2})\/(\d{2})\/(\d{4}) (\d{2}):(\d{2})/', trim($brDateTime))) {
                return Carbon::createFromFormat("d/m/Y H:i", trim($brDateTime))->toDateTimeString();
            }
            return $brDateTime;
        } catch (\Exception $e) {
            return $brDateTime;
        }
    }

    public static function removeMascara($campo)
    {
        $array = ['(', ')', '-', '.', '/', ' '];

        try {

            return str_replace($array, "", $campo);

        } catch (\Exception $e) {

            return $campo;

        }
    }


    private static function getfloat($str)
    {
        $str = str_replace('R$ ', '', $str);

        if (strstr($str, ",")) {
            $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs
            $str = str_replace(",", ".", $str); // replace ',' with '.'
        }

        if (preg_match('#([0-9\.]+-)#', $str, $match)) { // search for number that may contain '.'
            return floatval($match[0]);
        } else {
            return floatval($str); // take some last chances with floatval
        }
    }
}
