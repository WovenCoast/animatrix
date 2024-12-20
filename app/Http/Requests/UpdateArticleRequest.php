<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'published' => $this->has('published'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('articles', 'title')->ignore($this->route('article')),
                'max:255'
            ],
            'slug' => [
                Rule::unique('articles', 'slug')->ignore($this->route('article')),
                'max:255'
            ],
            'excerpt' => '',
            'content' => '',
            'published' => 'boolean',
//            'published_at' => 'required_if:published,1|date_format:Y-m-d H:i:s',
            'published_at' => 'required_if:published,1|date',
            'featured_image' => 'mimes:jpeg,png,gif,tiff,svg',
        ];
    }
}
