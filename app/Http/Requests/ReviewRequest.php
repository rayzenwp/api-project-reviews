<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string',
            'theme_code' => 'required|string',
            'thumbnail' => 'file|mimes:jpg,png',
            'body' => 'required|string|max:500',
            'like_count' => 'integer'
        ];
    }
}
