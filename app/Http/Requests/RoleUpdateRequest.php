<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RealRashid\SweetAlert\Facades\Alert;

class RoleUpdateRequest extends FormRequest
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
            'role_name' => ['required'],
            'desc' => ['nullable']
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $html = "<ul style='list-style: none;'>";
        foreach($validator->errors()->getMessages() as $error) {
            $html .= "<li>$error[0]</li>";
        }
        $html .= "</ul>";
        Alert::html('Something went worng..', $html, 'error');

        return redirect()->back();
    }
}
