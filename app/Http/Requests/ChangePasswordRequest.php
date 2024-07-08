<?php

namespace App\Http\Requests;

use App\Rules\DifferentPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required|string|min:6|max:16|current_password:web',
            'new_password' => ['required', 'string', 'min:6', 'max:16', new DifferentPassword]
        ];
    }
}
