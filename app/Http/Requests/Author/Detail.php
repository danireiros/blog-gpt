<?php

namespace App\Http\Requests\Author;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class Detail extends FormRequest
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
        /* $detailId = $this->route('detail') ?? null; // Obtener el ID del registro si existe */

        return [
            'details' => 'required|min:5|max:255',
            'author_general_id' => [
                'required',
                'exists:author_generals,id',
                /* Rule::unique('author_details', 'author_general_id')->ignore($detailId), */
            ],
        ];
    }
}
