<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'description' => 'required|string',
            'image' => 'nullable|mimes:png,jpeg,jpg,webp'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'you must fill in the name field',
            'name.min' => 'The name must be at least :min characters long.',
            'name.max' => 'The name must not exceed :max characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string of characters.',
            'image.mimes' => 'Please use a valid format for the image.',

        ];
    }
}
