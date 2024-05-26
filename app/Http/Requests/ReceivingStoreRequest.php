<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceivingStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id.*' => 'required|exists:products,id',
            'batch.*' => 'required|string',
            'qty.*' => 'required|integer|min:1',
            'exp_date.*' => 'required|date_format:d/m/Y',
            'prod_date.*' => 'required|date_format:d/m/Y',
            'sbin_id.*' => 'required|exists:storage_bins,id',
            'sloc_id.*' => 'required|exists:storage_locations,id',
        ];
    }
}
