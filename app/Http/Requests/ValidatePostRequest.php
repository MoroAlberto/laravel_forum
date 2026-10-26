<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // runs before validation, so non-owners get a 403 instead of validation errors
        $post = $this->route('post');

        return $post
            ? $this->user()->can('update', $post)
            : $this->user()->can('create', Post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', Rule::unique('posts')->ignore($this->route('post'))],
            'content' => ['required', 'string'],
            'post_type_id' => ['required', 'integer', 'min:1', 'exists:post_types,id'],
        ];
    }
}
