<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * Returns true to allow the request since we don't have any specific authorization logic.
     *
     * @return bool True to authorize the request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * Defines the validation rules for the new password and its confirmation.
     * Both password fields are required, the new password must be at least 8 characters,
     * and they must match the confirmation password.
     *
     * @return array The validation rules for the request.
     */
    public function rules(): array
    {
        return [
            'new_password' => ['required', 'min:8', 'confirmed'],
            'new_password_confirmation' => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * Provides custom error messages for validation failures.
     * Ensures that users receive clear and localized feedback on what went wrong.
     *
     * @return array Custom error messages for the validation rules.
     */
    public function messages(): array
    {
        return [
            'new_password.required' => 'Harap mengisi password',
            'new_password.confirmed' => 'Konfirmasi password dan password tidak sama',
            'new_password.min' => 'Password harus memiliki lebih dari 8 karakter',
            'new_password_confirmation.required' => 'Harap mengisi konfirmasi password'
        ];
    }
}
