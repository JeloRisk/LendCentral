<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'identifier' => strpos($this->input('identifier'), '@')
                ? 'required_if:nim,null|string|email|max:255'
                : 'required_if:email,null|string|regex:/^[0-9]+$/|max:17',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
