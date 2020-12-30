<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Infrastructure\Requests\JsonRequest;

class CreateUserRequest extends JsonRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users', 'email']
        ];
    }

    public function messages()
    {
        return [
            'user_code.required' => 'User Code Required'
        ];
    }
}
