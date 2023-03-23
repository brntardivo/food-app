<?php

namespace App\Helpers;

class PhoneFormatter
{
    public static function validate(string $value): bool 
    {
        $phone        = self::parse($value);

        //## ## ##### ####
        return in_array(strlen($phone), [12, 13]);
    }

    public static function parse(string $value): string
    {
        $phone = preg_replace('/[^0-9]/', '', $value);

        if(in_array(strlen($phone), [10, 11]))
        {
            $phone = '55' . $phone;
        }else if(strlen($phone) === 12 && substr($phone, 0, 1) == 0)
        {
            $phone = '55' . substr($phone, 1, 11);
        }

        return $phone;
    }

    public static function format(string $value): string
    {
        if(self::validate($value))
        {
            // +## (##) #####-#### | +## (##) ####-####
            $formatted  = '+' . substr( $value, 0, 2) . ' (';
            $formatted .= substr( $value, 2, 2 ) . ') ';

            switch(strlen($value))
            {
                case 12:
                    $formatted .= substr( $value, 4, 4 ) . '-';
                    $formatted .= substr( $value, 8, 4 ) . '';
                    break;
                case 13:
                    $formatted .= substr( $value, 4, 5 ) . '-';
                    $formatted .= substr( $value, 9, 4 ) . '';
                    break;
            }           
            
            return $formatted;
        }

        return $value;
    }
}