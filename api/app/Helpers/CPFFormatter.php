<?php

namespace App\Helpers;

class CPFFormatter
{
    public static function validate(string $value): bool 
    {
        $cpf        = self::parse($value);

        $invalid    = [
            '00000000000',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999'
        ];    

        if (in_array($cpf, $invalid) || strlen($cpf) != 11)
        {
            return false;
        }
    
    
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--)
        {
            $soma    += $cpf[$i] * $j;
        }
    
        $resto    = $soma % 11;

        if ($cpf[9] != ($resto < 2 ? 0 : 11 - $resto))
        {
            return false;
        }
    
    
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--)
        {
            $soma    += $cpf[$i] * $j;
        }
    
        $resto    = $soma % 11;

        if($cpf[10] != ($resto < 2 ? 0 : 11 - $resto))
        {
            return false;
        }       

        return true;
    }

    public static function parse(string $value): string
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

    public static function format(string $value): string
    {
        if(self::validate($value))
        {
		    // ###.###.###-##
            $formatted  = substr( $value, 0, 3 ) . '.';
            $formatted .= substr( $value, 3, 3 ) . '.';
            $formatted .= substr( $value, 6, 3 ) . '-';
            $formatted .= substr( $value, 9, 2 ) . '';
            
            return $formatted;
        }

        return $value;
    }
}