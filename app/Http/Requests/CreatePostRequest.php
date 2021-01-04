<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Infrastructure\Requests\JsonRequest;

class CreatePostRequest extends JsonRequest
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
            'author' => ['required', 'string'],
            'title' => ['required', 'string'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'image_url' => ['required', 'string'],
            'is_featured' => ['required', 'boolean']
        ];
    }

    public function messages()
    {
        return [
            'user_code.required' => 'User Code Required'
        ];
    }
}
