<?php

namespace App\Helpers;

class CNPJFormatter 
{
    public static function validate(string $value): bool 
    {
        $cnpj       = self::parse($value);
 
        $invalid    = [
            '00000000000000',
            '11111111111111',
            '22222222222222',
            '33333333333333',
            '44444444444444',
            '55555555555555',
            '66666666666666',
            '77777777777777',
            '88888888888888',
            '99999999999999'
        ];
    
        if (in_array($cnpj, $invalid) || strlen($cnpj) != 14)
        {
            return false;
        }
    
    
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma        += $cnpj[$i] * $j;
            $j           = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto        = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
        {
            return false;
        }
    
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma    += $cnpj[$i] * $j;
            $j       = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
        
    }

    public static function parse(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function format(string $value): string
    {
        if(self::validate($value))
        {
		    // ##.###.###/####-##
            $formatted  = substr( $value, 0, 3 ) . '.';
            $formatted .= substr( $value, 3, 3 ) . '.';
            $formatted .= substr( $value, 6, 3 ) . '/';
            $formatted .= substr( $value, 9, 4 ) . '-';
            $formatted .= substr( $value, 13, 2 ) . '';
            
            return $formatted;
        }

        return $value;
    }
}