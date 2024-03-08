<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;

class Put extends FormRequest
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
            'name' => 'required|min:5|max:255',
            /* 'image' => 'required', */
            'description' => 'required|min:5|max:255',
            'system_prompt' => 'required|min:5|max:255',
            /* 'type' => 'required', */
            'category_id' => 'required|exists:categories,id',
            'subcategory' => 'required|min:5|max:255',
        ];
    }
}
