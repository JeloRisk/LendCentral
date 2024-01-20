<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateBorrowedItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'asset_tag' => 'required|string',
            // 'user_id' => 'integer',


            // 'name' => 'required|string',
            // 'email' => 'string|email',
            'borrowed_date' => 'timestamp',
            // 'until_date' => 'date',
            // 'return_date' => 'date',
            'returner_name' => 'required|string',
            'remarks' => 'string',
        ];
    }
}
