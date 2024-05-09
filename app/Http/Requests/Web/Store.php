<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:255',
            'image' => 'required',
            'description' => 'required|min:5|max:255',
            'domain' => 'required|min:5|max:255',
            'category_id' => 'required|exists:categories,id',
            'news_subdomain' => 'max:255',
            'style' => 'max:255',
            'news_container_content_start' => 'required|min:5|max:255',
            'news_container_content_end' => 'required|min:5|max:255',
            'new_content_start' => 'required|min:5|max:255',
            'new_content_end' => 'required|min:5|max:255',
        ];
    }
}
