<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class Put extends FormRequest
{
    public function prepareForValidation()
    {
        if (str($this->slug)->trim() == "")
            $this->merge([
                'slug' => str($this->title)->slug()
            ]);
    }
    
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
            'title' => 'required|min:5|max:255',
            'slug' => 'required|min:5|max:255|unique:posts,slug,' . $this->route("post")->id,
            'category_id' => 'required|exists:categories,id',
            'text' => 'required|min:5',
            'description' => 'required|min:5|max:255',

            'posted' => 'required',
            'type' => 'required',
            //'date' => 'required',
            //'image' => 'required',
        ];
    }
}
