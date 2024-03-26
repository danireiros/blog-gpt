<?php

namespace App\Http\Requests\OpenAi\Text;

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
            'model_name' => 'required|min:2|max:255',
            'temperature' => 'required|decimal:1',
            'max_tokens' => 'required|integer',
            'top_p' => 'required|integer',
        ];
    }
}
