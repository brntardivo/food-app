<?php

namespace App\Helpers;

class ZipCodeFormatter
{
    public static function validate(string $value): bool 
    {
        $zip_code        = self::parse($value);

        return strlen($zip_code) === 8;
    }

    public static function parse(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function format(string $value): string
    {
        if(self::validate($value))
        {
            // #####-###
            $formatted  = substr( $value, 0, 5 ) . '-';
            $formatted .= substr( $value, 5, 3 ) . '';
            
            return $formatted;
        }

        return $value;
    }
}