<?php

namespace App\Http\Requests\Author;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Person extends FormRequest
{
    public function prepareForValidation()
    {
        if (str($this->username)->trim() == "")
            $this->merge([
                'username' => str($this->username)->username()
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
        $personId = $this->route('person') ?? null; // Obtener el ID del registro si existe

        return [
            'other' => 'required|min:5|max:255',
            'username' => 'required|min:5|max:255|unique:author_persons',
            'choices' => 'required',
            'author_general_id' => [
                'required',
                'exists:author_generals,id',
                Rule::unique('author_persons', 'author_general_id')->ignore($personId),
            ],
        ];
    }
}
