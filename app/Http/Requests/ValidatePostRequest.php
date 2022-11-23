<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|string|unique:posts|max:255',
            'content' => 'required|string',
            'post_type_id' => 'required|integer|min:1|exists:post_types,id',
        ];
        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['title'] = 'required|string|max:255';
        }
        return $rules;
    }
}
