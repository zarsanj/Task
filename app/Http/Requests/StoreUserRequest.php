<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            User::NAME => 'required|string',
            User::EMAIL => 'required_without:mobile|email:rfc,dns|unique:users',
            User::MOBILE => 'required_without:email|string|unique:users',
            User::PASSWORD => 'required|confirmed',
        ];
    }
}
