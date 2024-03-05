<?php

namespace App\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Company extends FormRequest
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
        $companyId = $this->route('company') ?? null; // Obtener el ID del registro si existe

        return [
            //'name' => 'required|min:5|max:255',
            'CIF' => 'required|min:5|max:255',
            'email' => 'required|min:5|max:255|email',
            'extra' => 'required|min:5|max:255',
            //'image' => 'required|min:5|max:255',
            'author_general_id' => [
                'required',
                'exists:author_generals,id',
                Rule::unique('author_companies', 'author_general_id')->ignore($companyId),
            ],
            'choices' => 'required',
        ];
    }
}
