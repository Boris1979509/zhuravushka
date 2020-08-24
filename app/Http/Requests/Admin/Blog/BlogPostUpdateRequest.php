<?php

namespace App\Http\Requests\Admin\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogPostUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|min:5|max:200',
            'excerpt'     => 'nullable|max:500|min:3',
            'content'     => 'required|string|min:3|max:10000',
            'category_id' => 'required|exists:blog_categories,id',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'category_id' => __('Category'),
            'content'     => __('Article'),
            'title'       => __('Title'),
            'excerpt'     => __('Excerpt'),
        ];
    }
}
