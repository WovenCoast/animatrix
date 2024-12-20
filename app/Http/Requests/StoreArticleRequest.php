<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required|unique:articles|max:255',
            'slug' => 'required|unique:articles|max:255',
            'excerpt' => 'required',
            'content' => 'required',
            'published' => [
                'boolean',
            ],
            'published_at' => '',
            'featured_image' => 'required|mimes:jpeg,png,gif,tiff,svg',
        ];
    }
}
