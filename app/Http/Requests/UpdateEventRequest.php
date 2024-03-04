<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'location' => 'required|string',
            'seats' => 'required|integer|min:1',
            'price' => 'required|integer|min:0',
            'date' => 'required|date|after_or_equal:today',
            'type' => 'required|in:automatic,manual',
            'category' => 'required|exists:categories,id', // assuming categories table has 'id' column
            'image' => 'nullable|image|mimes:png,jpeg,jpg,webp|max:2048', // max file size in kilobytes (2MB)
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'You must fill in the name field.',
            'name.min' => 'The name must be at least :min characters long.',
            'name.max' => 'The name must not exceed :max characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description field must be a string of characters.',
            'location.required' => 'The location field is required.',
            'location.string' => 'The location field must be a string of characters.',
            'seats.required' => 'The seats field is required.',
            'seats.integer' => 'The seats field must be an integer.',
            'seats.min' => 'The seats field must be at least :min.',
            'price.required' => 'The price field is required.',
            'price.integer' => 'The price field must be an integer.',
            'price.min' => 'The price field must be at least :min.',
            'date.required' => 'The date field is required.',
            'date.date' => 'Invalid date format.',
            'date.after_or_equal' => 'The date must be today or in the future.',
            'type.required' => 'The type field is required.',
            'type.in' => 'Invalid type value.',
            'category.required' => 'The category field is required.',
            'category.exists' => 'Selected category does not exist.', // assuming categories table has 'id' column
            'image.image' => 'Please upload a valid image file.',
            'image.mimes' => 'Please use a valid format for the image.',
            'image.max' => 'The image file size must be less than :max kilobytes.', // max file size in kilobytes (2MB)
        ];
    }
}
