<?php

namespace App\Http\Requests\Management;

use App\Rules\DocumentRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBranchRequest extends FormRequest
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
            'name' => 'required',
            'trading_name' => 'required',
            'company_name' => 'required',
            'document' => ['required', 'string', Rule::unique('branches')->ignore($this->branch->id), new DocumentRule],
        ];
    }
}
