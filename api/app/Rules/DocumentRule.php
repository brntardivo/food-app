<?php

namespace App\Rules;

use App\Helpers\CNPJFormatter;
use App\Helpers\CPFFormatter;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DocumentRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $document = CPFFormatter::parse($value);

        switch(strlen($document)) {
            //CPF
            case 11:
                if (! CPFFormatter::validate($value)) {
                    $fail('The :attribute is not a valid CPF');
                }
                break;

                //CNPJ
            case 14:
                if (! CNPJFormatter::validate($value)) {
                    $fail('The :attribute is not a valid CNPJ');
                }
                break;

            default:
                $fail('The :attribute is not a valid document');
                break;
        }
    }
}
