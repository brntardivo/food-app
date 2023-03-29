<?php

namespace App\Http\Requests\Management;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBranchAddressRequest extends FormRequest
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
            'address' => 'required|string',
            'complement' => 'nullable|string',
            'zip_code' => 'required|string|min:8|max:9',
            'district' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|size:2',
        ];
    }
}
