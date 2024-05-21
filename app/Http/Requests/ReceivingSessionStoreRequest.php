<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceivingSessionStoreRequest extends FormRequest
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
            'product' => ['required'],
            'batch' => ['required', 'max:9'],
            'sloc' => ['required'],
            'sbin' => ['required'],
            'qty' => ['required', 'integer'],
            'prod_date' => ['required'],
            'exp_date' => ['required'],
        ];
    }
}
