<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;

class StoreBranchOpeningHoursSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'weekday' => 'required|integer|between:0,6',
            'opens_at' => 'required|date_format:H:i|before:closes_at',
            'closes_at' => 'required|date_format:H:i',
        ];
    }
}
