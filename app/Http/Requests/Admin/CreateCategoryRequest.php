<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255|unique:categories,name',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'parent_id' => 'nullable|integer|exists:categories,id',
            'status' => 'required|in:active,archived',
        ];
    }
}
