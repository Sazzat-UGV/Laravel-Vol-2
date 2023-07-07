<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required|string|max:255|unique:pages',
            'slug'=>'nullable|string|max:255|unique:pages',
            'short_description'=>'nullable|string',
            'long_description'=>'nullable|string',
            'page_image'=>'nullable|image|mimes:png,jpg',
            'meta_title'=>'nullable|string|max:255',
            'meta_description'=>'nullable|string|max:255',
            'meta_keywords'=>'nullable|string|max:255',
        ];
    }
}
