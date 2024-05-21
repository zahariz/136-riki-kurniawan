<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RMFSessionUpdateRequest extends FormRequest
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
            'e_product' => ['required'],
            'e_batch' => ['required', 'max:9'],
            'e_sloc' => ['required'],
            'e_sbin' => ['required'],
            'e_qty' => ['required', 'integer'],
        ];
    }
}
