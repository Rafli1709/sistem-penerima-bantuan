<?php

namespace App\Http\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * This function determines if the user is authorized to submit the login request.
     *
     * @return bool True if the user is authorized to make the request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * This function returns the validation rules for the request.
     * It ensures that the email is required, a valid email, and exists in the database.
     * It also ensures the password is required and a string.
     *
     * @return array Validation rules for the login request.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * This function defines custom error messages for validation failures during login.
     * It ensures users receive feedback about what went wrong with their input.
     *
     * @return array Custom error messages for validation failures.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Harap mengisi username atau email',
            'email.string' => 'Email harus berupa teks yang valid',
            'email.email' => 'Email harus memiliki format email yaitu (@)',
            'email.exists' => 'Email ini tidak terdaftar dalam sistem',
            'username.required' => 'Harap mengisi username atau email',
            'username.string' => 'Username harus berupa teks yang valid',
            'username.exists' => 'Username ini tidak terdaftar dalam sistem',
            'password.required' => 'Harap mengisi password',
            'password.string' => 'Password harus berupa teks yang valid',
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * This function attempts to authenticate the user with the provided credentials (email and password).
     * If authentication fails, it will hit the rate limiter and throw an exception with an error message.
     *
     * @throws \Illuminate\Validation\ValidationException Thrown if authentication fails.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'password' => __('Password yang anda masukkan salah'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * This function checks if the login attempts for the user exceed the limit.
     * If exceeded, it locks out the user for a certain time.
     *
     * @throws \Illuminate\Validation\ValidationException Thrown if too many attempts have been made.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * This function generates a throttle key based on the user's email and IP address
     * to prevent multiple failed login attempts from the same user.
     *
     * @return string The throttle key for rate limiting.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
